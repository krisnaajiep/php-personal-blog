<?php

/**
 * Class Article
 * 
 * This class handles CRUD operations for managing articles stored as JSON files.
 */
class Article
{
  /**
   * @var string $dir The directory where article JSON files are stored.
   * @var string $pattern The pattern to match article files in the directory.
   */
  private $dir = 'articles/', $pattern = 'articles/*.json';

  /**
   * Create a new article
   *
   * @param array $data The input data for the article.
   * - Validates input data against predefined rules.
   * - Saves the validated data as a JSON file in the articles directory.
   * - Sets a success flash message and redirects to the admin page.
   * @return void
   */
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

  /**
   * Retrieve a list of all articles.
   *
   * @return array An array of articles with their content and metadata.
   * - Reads all JSON files in the articles directory.
   * - Parses the content and appends article IDs to the data.
   */
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

  /**
   * Show a single article by its filename as ID.
   *
   * @param integer $id The filename as ID of the article to fetch.
   * @return array|null The article data if found, or redirects to the home page.
   */
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

  /**
   * Update an existing article.
   *
   * @param array $data The updated data for the article, including its filename as ID.
   * - Validates the input data against predefined rules.
   * - Overwrites the existing JSON file with the updated data.
   * - Sets a success flash message and redirects to the admin page.
   * @return void
   */
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

  /**
   * Delete an article by its filename as ID.
   *
   * @param integer $id The filename ID of the article to delete.
   * - Removes the corresponding JSON file from the directory.
   * - Sets a success flash message and redirects to the admin page.
   * @return void
   */
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
