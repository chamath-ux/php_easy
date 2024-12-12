<?php

namespace Support\lib;

class Response{

    /**
     * Send a JSON response.
     * 
     * @param array $data
     * @param int $statusCode
     * @return void
     */

    public function json(array $data, int $statusCode = 200)
    {
         // Set HTTP status code
         http_response_code($statusCode);

         // Set Content-Type to JSON
         header('Content-Type: application/json');
 
         // Output the JSON-encoded response
         echo json_encode($data);
 
         // End script execution
         exit;
    }

}