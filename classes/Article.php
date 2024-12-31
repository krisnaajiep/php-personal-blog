<?php

class Article
{
  private $dir = 'articles/', $pattern = 'articles/*.json';

  public function create(array $data)
  {
    $validated = Validator::setRules($data, [
      'article_title' => ["required", "alpha_num_space", "min_length:5", "max_length:100"],
      'publishing_date' => ["required", "date"],
      'content' => ["required", "min_length:100", "max_length:10000"],
    ]);

    $files = glob($this->pattern);
    $existIndex = array_map(fn($v) => intval(explode('/', $v)[1][0]), $files);
    $i = count($files);
    if (in_array($i, $existIndex)) $i++;

    if (!file_exists($this->dir)) mkdir($this->dir);

    file_put_contents($this->dir . $i . '.json', json_encode($validated, JSON_PRETTY_PRINT));

    header('Location: admin.php');
  }
}
