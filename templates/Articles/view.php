<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    img {
      max-width: 100%;
      height: auto;
    }
    .article-container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }
  </style>
</head>

<div class="article-container">
  <h1><?= h($article->title) ?></h1>
  <p><small>Created: <?= $article->created->format(DATE_RFC850) ?></small></p>
  <p><?= h($article->body) ?></p>
  
  <?php  if($article->filename!= '' )
  {   
  ?>
  <div class="center"><?php echo $this->Html->image('uploads/users/' . $article->filename); ?></div>
  <?php  }  ?>
</div>