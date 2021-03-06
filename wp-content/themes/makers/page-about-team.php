<?php
/**
 * Template Name: About Team
 * @package WordPress
 */


global $post;

$members = array();
$customList = array('role', 'email', 'facebook', 'linkedin', 'twitter', 'type');

$args = array('numberposts' => 100, 'category_name' => 'teammembers');
$posts = get_posts($args);

$categoriesAll = array();
$firstCategory = null;

foreach ($posts as $post) {
    $custom = get_post_custom($post->ID);
    $featuredImageId = get_post_thumbnail_id($post->ID);
    $image = wp_get_attachment_image_src($featuredImageId, array(524, 524));

    $members[$post->ID] = array(
        'id' => $post->ID,
        'name' => $post->post_title,
        'desc' => $post->post_content,
        'image' => isset($image[0]) ? $image[0] : ''
    );

    foreach ($customList as $cfield) {
        $members[$post->ID][$cfield] = isset($custom[$cfield][0]) ? $custom[$cfield][0] : "";
    }

    if (!empty($members[$post->ID]['type'])) {
        $categories = explode(' ', $members[$post->ID]['type']);
        foreach ($categories as $c) {
            $c = trim($c);
            if (!$c) continue;
            if (empty($categoriesAll)) {
                $firstCategory = $c;
            }
            $categoriesAll[$c] = $c;
        }
    }
}

get_header(); ?>

<div class="sub-navigation-container">
    <div class="sub-navigation">
        <div class="sub-navigation-inner">
            <nav>
                <ul class="sub-navigation-menu">
                    <li><a href="<?php bloginfo('url') ?>/about-culture/">Culture</a></li>
                    <li class="active"><a href="<?php bloginfo('url') ?>/about-team/">Team</a></li>
                    <li><a href="<?php bloginfo('url') ?>/about-process/">Process</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

    <main>

    <div class="container intro">
        <article>
          <section class="content">
            <h4>Mission</h4>
            <h2>Building next generation tech companies</h2>
            <p>Makers strives to be different. We at Makers strongly believe that innovation doesn’t happen by chance. Disruptive products and services are always designed by outstanding teams and founders don’t hesitate to challenge the status quo. Our vision is to provide a platform for entrepreneurs to think ahead and develop products that create true value.</p>
          </section>
        </article>
      </div>

        <div class="container container--follow">
            <article>
                <!--<header>
                    <h2>Meet the Makers</h2>

                    <p>Our team consists of professionals with a wide range of expertise and entrepreneurial minds. And
                        we're in for the same mission: We challenge the status quo and build products that people want
                        and need.</p>
                </header>-->
                <section class="about-team">
<!--                    <ul class="categories">-->
<!--                        --><?php //foreach ($categoriesAll as $filter=>$title): ?>
<!--                        <li class="--><?php //if ($filter == $firstCategory) echo 'active'?><!--" data-filter="--><?php //echo htmlspecialchars($filter)?><!--">-->
<!--                            <a href="javascript: void(0)" title="--><?php //echo htmlspecialchars($title)?><!--">--><?php //echo htmlspecialchars($title)?><!--</a>-->
<!--                        </li>-->
<!--                        --><?php //endforeach; ?>
<!--                    </ul>-->
                    <ul class="posts members list-3">
                        <?php foreach ($members as $m): ?>
<!--                            <li class="all --><?php //echo $m['type']; if (!substr_count($m['type'], $firstCategory)) echo ' hidden' ?><!--">-->
                            <li class="all <?php echo $m['type']?>">
                                <img src="<?php echo $m['image'] ?>" width="524" height="524" alt="">

                                <div class="team-hover">
                                    <div class="table">
                                        <div class="table-cell">
                                            <h4><?php echo $m['name'] ?></h4>

                                            <p><?php echo $m['role'] ?></p>

                                            <?php if (!empty($m['email'])): ?>
                                            <p><a href="mailto:<?php echo $m['email'] ?>"><?php echo $m['email'] ?></a></p>
                                            <?php endif;?>
                                            <ul class="social">
                                                <?php if (!empty($m['facebook'])): ?>
                                                <li class="facebook"><a href="<?php echo $m['facebook'] ?>"
                                                                        title="facebook">facebook</a></li>
                                                <?php endif;?>
                                                <?php if (!empty($m['linkedin'])): ?>
                                                <li class="linkedin"><a href="<?php echo $m['linkedin'] ?>"
                                                                        title="linkedin">linkedin</a></li>
                                                <?php endif;?>
                                                <?php if (!empty($m['twitter'])): ?>
                                                <li class="twitter"><a href="<?php echo $m['twitter'] ?>"
                                                                       title="twitter">twitter</a></li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </section>
            </article>
        </div>

    </main>
<!--<script>-->
<!--    $(function() {-->
<!--        $('ul.categories > li').click(function() {-->
<!--            var el = this;-->
<!--            $('ul.categories > li').removeClass('active');-->
<!--            $(el).addClass('active');-->
<!--            $('ul.members > li').addClass('hidden');-->
<!--            var filter = $(el).attr('data-filter');-->
<!--            $('ul.members li.' + filter).removeClass('hidden');-->
<!--        });-->
<!--    });-->
<!--</script>-->
<?php get_footer(); ?>
