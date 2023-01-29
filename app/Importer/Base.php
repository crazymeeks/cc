<?php

namespace App\Importer;

use Exception;


abstract class Base
{


    public function readCsv()
    {
        $row = 0;
        $handle = fopen($this->getFile(), "r");

        if ($handle === false) {
            return false;
        }

        while (($data = fgetcsv($handle, 0, ",")) !== false) {
            if ($row != 0) {
                if (count($data) > 1) {
                    $exploded = explode(';', $data[0]);
                    $exploded2 = explode(';', $data[1]);

                    $exploded[count($exploded)-1] .= sprintf(",%s", $exploded2[0]);
                    if (count($exploded2) > 1) {
                        $exploded[] = $exploded2[1];
                    }

                    $implode = implode(';', $exploded);
                    $data[0] = $implode;
                }
                yield $data[0];
            }
            $row++;
        }
        fclose($handle);
    }

    /**
     * Get file
     *
     * @return string
     * 
     * @throws \Exception
     */
    public function getFile()
    {
        throw new Exception(sprintf("The %s does not implement getFile() method", get_class($this)));
    }
}