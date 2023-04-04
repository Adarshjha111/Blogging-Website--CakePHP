<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Load Bootstrap 4 CSS -->
    <?= $this->Html->css('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css') ?>
</head>
<!-- Add Bootstrap 4 classes to make the layout responsive -->
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>Edit Article</h1>
            <?= $this->Form->create($article, ["enctype" => "multipart/form-data"]) ?>
            <div class="form-group">
                <?= $this->Form->control('title', ['class' => 'form-control']) ?>
            </div>
            <div class="form-group">
                <?= $this->Form->control('body', ['rows' => '8', 'class' => 'form-control']) ?>
            </div>
            <?php if ($article->filename != '') : ?>
                <div class="form-group">
                    <?= $this->Html->image('uploads/users/' . $article->filename, [
                        'height' => 100,
                        'width' => 100,
                        'class' => 'img-thumbnail'
                    ]) ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <?= $this->Form->control('filename', ['type' => 'file', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form-control-file']) ?>
            </div>
            <div class="form-group">
                <?= $this->Form->button(__('Save Article'), ['class' => 'btn btn-primary']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>