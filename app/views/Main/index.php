<h1>Hello</h1>
<p><?= $name; ?></p>
<p><?= $age; ?></p>
<p>Height: <?= $properties["height"] ?></p>
<?php foreach ($posts as $post): ?>
    <h3><?= $post->title; ?></h3>
<?php endforeach; ?>
<?php var_dump($data); ?>
