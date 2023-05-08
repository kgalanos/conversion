<?php

namespace kgalanos\conversion\File;

class ToCodepage
{
    protected $stream;

    public function __construct(protected string $filename)
    {
        if (! file_exists($filename)) {
            throw new \Exception('not found file :'.$filename);
        }

        try {
            $this->stream = fopen($filename, 'r');
        } catch (\Exception $exception) {
            throw new \Exception('can not open file :'.$filename);
        }
    }

    public function fileClose()
    {
        fclose($this->stream);
    }

    public static function checkString(string $data, array|string|null $encoding = 'UTF-8', bool $strict = false)
    {
        return mb_detect_encoding($data, $encoding, $strict);
    }

    public function check($encoding = 'UTF-8'): bool
    {
        /*
        * Read the first line from file
        * We must check all file not only 1 line
        */
        rewind($this->stream);
        $tmp_rtn = true;
        while ((($line = fgets($this->stream, 4096)) !== false) and ($tmp_rtn)) {
            $tmp_rtn = $this->checkString($line, $encoding, true);
        }
        /*
        * if file is not UTF-8 convert it
        */
        return $tmp_rtn;
    }

    public function convert($encoding = 'UTF-8')
    {
        //        $in = fopen($this->filename, "r");
        rewind($this->stream);
        $out = fopen($this->filename.'.utf8', 'w+');
        while (($line = fgets($this->stream, 4096)) !== false) {
            //        $line = iconv('windows-1253',$this->encoding,$line);
            $line = mb_convert_encoding($line, $encoding, 'iso-8859-7');
            fwrite($out, $line);
        }
        $this->fileClose();
        fclose($out);
        rename($this->filename, $this->filename.'.original');
        rename($this->filename.'.utf8', $this->filename);
    }
}
