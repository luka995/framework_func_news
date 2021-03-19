<div class="row">
<?php foreach ($posts as $post):?>
<div class="col-md-4">
  <div class="card mb-4 box-shadow">
    <img class="card-img-top" src="<?=$post['img']?>" alt="Slika">
    <div class="card-body">
        <h3>
            <a href="?page=view_post&id=<?= intval($post['id'])?>"><?= htmlspecialchars($post['title']) ?></a>
        </h3>
        <p class="card-text">
            <?= mb_substr(htmlspecialchars(strip_tags($post['content'])), 0, 300, "UTF-8") ?>
        </p>
      <div class="d-flex justify-content-between align-items-center">
        <div class="btn-group">
          <a href="?page=view_post&id=<?= intval($post['id'])?>" class="btn btn-sm btn-outline-secondary">Pregled</a>
        </div>
        <small class="text-muted">
            <?= htmlspecialchars($post['full_name'])?>, <?= date('d.m.Y.', strtotime($post['pub_time'])) ?>
        </small>
      </div>
    </div>
  </div>
</div>
<?php endforeach;?>
</div>