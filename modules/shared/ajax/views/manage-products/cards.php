<?php

$products     = $data['products'] ?? [];
$pagination   = $data['pagination'] ?? [];

$total_pages  = $pagination['pages'] ?? 1;
$paged        = $pagination['page'] ?? 1;

$is_user = $data['is_user'] ?? false;

?>

<?php
// Load this view's CSS when the view is rendered (AJAX or include).
echo '<link rel="stylesheet" href="' . esc_url( plugins_url( 'assets/cards.css', __FILE__ ) ) . '" />';
?>

<div class="sty-cards-grid">

<?php if(!empty($products)): ?>

<?php foreach($products as $p): ?>

<?php
$id     = $p->get_id();
$price  = $p->get_regular_price();
$img    = $p->get_image('medium');
$status = $p->get_status();

$terms = wp_get_post_terms($id,'product_cat',['fields'=>'names']);

$is_deactivated =
    get_post_meta($id,'_styliiiish_manual_deactivate',true)==='yes';
?>

<div class="sty-card <?= $is_deactivated?'is-deactivated':'' ?>" data-id="<?= esc_attr($id) ?>">

    <!-- Image -->
   <div class="card-thumb">

    <?= $img ?>

    <!-- Status -->
    <span class="card-badge badge-<?= esc_attr($status) ?>">
        <?= esc_html__( ucfirst($status), 'website-flexi' ) ?>
    </span>

    <?php if($is_deactivated): ?>
        <span class="card-badge badge-off">
            <?= esc_html__('Deactivated','website-flexi') ?>
        </span>
    <?php endif; ?>

    <!-- Delete Button -->
    <button
        class="card-delete-btn btn-delete"
        data-id="<?= esc_attr($id) ?>"
        title="<?= esc_attr__('Delete product','website-flexi') ?>">
        🗑
    </button>

</div>



    <!-- Content -->
    <div class="card-content">

        <h4 class="card-title">
            <?= esc_html($p->get_name()) ?>
        </h4>

        <div class="card-meta">

            <span class="card-price">
                <?= $price ? esc_html($price).' EGP' : '—' ?>
            </span>

            <?php if(!empty($terms)): ?>
            <span class="card-cat">
                <?= esc_html($terms[0]) ?>
            </span>
            <?php endif; ?>

        </div>

    </div>


    <!-- Actions -->
    <div class="card-footer">

        <a href="#"
           class="card-btn btn-edit-product"
           data-id="<?= esc_attr($id) ?>">
           ✏️ Edit
        </a>

        <a href="<?= esc_url(get_permalink($id)) ?>"
           target="_blank"
           class="card-btn">
           👁 View
        </a>

        <?php if($is_user): ?>

            <?php if($is_deactivated): ?>

                <a href="#"
                   class="card-btn btn-activate-user"
                   data-id="<?= esc_attr($id) ?>">
                   ⚡ Activate
                </a>

            <?php else: ?>

                <a href="#"
                   class="card-btn btn-deactivate-user"
                   data-id="<?= esc_attr($id) ?>">
                   ❌ Deactivate
                </a>

            <?php endif; ?>

        <?php endif; ?>

    </div>

</div>

<?php endforeach; ?>

<?php else: ?>

<p class="sty-empty">No products found.</p>

<?php endif; ?>

</div>



<!-- Pagination -->
<?php if($total_pages>1): ?>

<div class="pagination-wrapper">

<?php for($i=1;$i<=$total_pages;$i++): ?>

<a href="#"
   class="button styliiiish-page-link <?= $i==$paged?'button-primary':'' ?>"
   data-page="<?= esc_attr($i) ?>">
   <?= $i ?>
</a>

<?php endfor; ?>

</div>

<?php endif; ?>


    
   <?php
// nothing

