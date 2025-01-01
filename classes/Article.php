<?php

class Article
{
  private $dir = 'articles/', $pattern = 'articles/*.json';

  public function create(array $data)
  {
    $validated = Validator::setRules($data, [
      'article_title' => ["required", "alpha_num_space", "max_length:100"],
      'publishing_date' => ["required", "date"],
      'content' => ["required", "max_length:10000"],
    ]);

    $files = glob($this->pattern);
    $existIndex = array_map(fn($v) => intval(explode('/', $v)[1][0]), $files);
    $i = count($files);
    if (in_array($i, $existIndex)) $i++;

    if (!file_exists($this->dir)) mkdir($this->dir);

    file_put_contents($this->dir . $i . '.json', json_encode($validated, JSON_PRETTY_PRINT));

    Flasher::setFlash('New article has been ', 'added.', 'success');

    header('Location: admin.php');
  }

  public function list(): array
  {
    $files = glob($this->pattern);
    $articles = [];

    if (!empty($files)) {
      foreach ($files as $file) {
        $filename = intval(explode('.', explode('/', $file)[1])[0]);
        $data = array_merge(['id' => $filename], json_decode(file_get_contents($file), true));

        $articles[] = $data;
      }
    }

    return $articles;
  }

  public function show(int $id): array|null
  {
    $files = glob($this->pattern);

    if (!empty($files)) {
      foreach ($files as $file) {
        $filename = intval(explode('.', explode('/', $file)[1])[0]);
        $data = array_merge(['id' => $filename], json_decode(file_get_contents($file), true));

        if ($id == $filename) return $data;
      }
    }

    header('Location: index.php');
    return null;
  }

  public function update(array $data)
  {
    $validated = Validator::setRules($data, [
      'article_title' => ["required", "alpha_num_space", "max_length:100"],
      'publishing_date' => ["required", "date"],
      'content' => ["required", "max_length:10000"],
    ]);

    file_put_contents($this->dir . $data['id'] . '.json', json_encode($validated, JSON_PRETTY_PRINT));

    Flasher::setFlash('An article has been ', 'updated.', 'success');

    header('Location: admin.php');
  }

  public function delete(int $id)
  {
    $filename = $this->dir . $id . '.json';

    if (file_exists($filename)) {
      unlink($filename);
      Flasher::setFlash('An article has been ', 'deleted.', 'success');
    }

    header('Location: admin.php');
  }
}
