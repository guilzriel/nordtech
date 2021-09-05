<?php

class University_domains_and_names_API{

    private $cnn;
    private $list_of_countries;
    private $results;

    function __construct($servername, $username, $password, $dbname)
    {

        if ( empty($servername) || empty($username) || empty($password) || empty($dbname) ){
            throw new exception('missing database credentials');
        }

        //connect to mysql
        $this->cnn = new mysqli($servername, $username, $password, $dbname) or die(mysqli_error($this->cnn));

    }

    function __destruct()
    {
        //close DB connection
        $this->cnn->close();
    }

    public function get_list_of_universities_from_api($urls){

        if (!is_array($urls)){
            if (strlen($urls) > 0){
                $this->list_of_countries = array($urls);
            }else{
                throw new exception('missing `Country` to call the API');
            }
        }else{
            $this->list_of_countries = $urls;
        }

        foreach ($this->list_of_countries as $country)
        {
            $this->results[$country] = $this->get_api($country);
        }

        return $this->results;
    }

    private function get_api($country){

        //curl here
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://universities.hipolabs.com/search?country=". urlencode($country),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($httpCode == 200){

            return json_decode($response);

        }else{
            throw new exception('something went wrong trying to call API: ' . curl_error($curl));
        }


    }

    public function insert_list($results)
    {

        foreach ($results as $country => $data)
        {
            foreach ($data as $key => $values) {

                $stmt = $this->cnn->prepare("INSERT INTO `universities` (`country`, `alpha_two_code`, `name`, `state-province`) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $values->country, $values->alpha_two_code, $values->name, $values->{'state-province'});
                $stmt->execute();

                $id_university = $this->cnn->insert_id;

                foreach ($values->web_pages as $url) {
                    $stmt = $this->cnn->prepare("INSERT INTO `web_pages` (`id_university`, `url`) VALUES (?, ?)");
                    $stmt->bind_param("is", $id_university, $url);
                    $stmt->execute();

                }

                foreach ($values->domains as $domain_name) {
                    $stmt = $this->cnn->prepare("INSERT INTO `domains` (`id_university`, `domain_name`) VALUES (?, ?)");
                    $stmt->bind_param("is", $id_university, $domain_name);
                    $stmt->execute();

                }
            }
        }

        $stmt->close();
    }

    public function get_list_of_universities()
    {
        $sql = 'SELECT distinct `name`, count( distinct(domain_name)) as url_count
FROM universities
LEFT JOIN domains ON (universities.id = domains.id_university)
group by `name`
order by `name`';
        $this->cnn->query($sql);

        if ($result =  $this->cnn->query($sql)) {
            while($obj = $result->fetch_object()){
               $rows[] = $obj;
            }
        }

        return $rows;
    }

}