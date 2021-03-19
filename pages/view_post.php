<div class="row">
    <div class="col-12">
        <h3>
            <?= htmlspecialchars($post['title'])?>       <br>
            <small>
                Autor: <?= htmlspecialchars($post['full_name'])?>, objavljeno:<?= date('d.m.Y.', strtotime($post['pub_time'])) ?>
            </small>
        </h3>

        <hr>
        <section> 
            <?= $post['content'] ?> 
        </section>
    </div>
</div>
<?php if (!empty($member['can_comment'])): ?>
<div class="row">
    <div class="col-12">      
        <form method="post">
            <textarea placeholder="Napišite komentar" class="form-control" rows="10" name="Comment[content]" required=""></textarea>
            <button type="submit" class="btn btn-primary">Objavi</button>
        </form>
    </div>
</div>    
<?php endif;?>

<hr>

<?php if (!empty($comments)): ?>
    <?php foreach ($comments as $comment):?>
    <div class="row">
        <div class="col-12">        
            <b>
                <?= htmlspecialchars($comment['full_name'])?>, <?= date('d.m.Y. H:i:s', strtotime($comment['pub_time'])) ?>
            </b>            
            <section> 
                <?= $comment['content'] ?> 
            </section>        
            <hr>
        </div>
    </div>    
    <?php endforeach;?>
<?php endif;?>
