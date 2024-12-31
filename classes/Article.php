<?php

class Article
{
  private $dir = 'articles/', $pattern = 'articles/*.json';

  public function create(array $data)
  {
    unset($data['publish']);
    $files = glob($this->pattern);
    $existIndex = array_map(fn($v) => intval(explode('/', $v)[1][0]), $files);
    $i = count($files);
    if (in_array($i, $existIndex)) $i++;

    if (!file_exists($this->dir)) mkdir($this->dir);

    file_put_contents($this->dir . $i . '.json', json_encode($data, JSON_PRETTY_PRINT));

    header('Location: admin.php');
  }
}
