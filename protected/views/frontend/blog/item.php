<div class="container" id="blog">
  <div class="row">
    <div class="span9">
      <article id="post-1478"
               class="row-fluid blog-article v1 normal post-1478 post type-post status-publish format-standard hentry category-news tag-news tag-event">
        <div class="span12">
          <div class="row-fluid">
            <div class="span12">
              <div class="content post_format_standart">
                <dl class="dl-horizontal">
                  <dt><i class="moon-pencil"></i></dt>
                  <dd>
                    <h3><a
                          href="<?= $this->createUrl('/blog/item', array('id' => $element->id)) ?>"><?= $element->name ?></a>
                    </h3>
                    <div class="info single_info">
                      <ul>
                        <li class="calendar"><? echo Yii::app()->dateFormatter->format('dd MMM yyyy kk:mm', $element->date_create) ?></li>
                        <li class="user"><?= Users::getUserName($element->created_by) ?></li>
                        <? if (!empty($element->tags)): ?>
                          <li class="tag">
                            <? foreach ($element->tags as $tag): ?>
                              <? echo $tag->name; ?>
                            <? endforeach; ?>
                          </li>
                        <? endif; ?>
                      </ul>
                    </div>
                    <div class="blog-content">
                      <? if ($element->preview_picture): ?>
                        <p><a href="<?= Files::getPath($element->preview_picture) ?>"><img
                                class="alignnone  wp-image-1483" src="<?= Files::getPath($element->preview_picture) ?>"
                                alt="wow-logo"/></a></p>
                      <? endif; ?>
                      <? if ($element->detail_text): ?>
                        <? echo $element->detail_text ?>
                      <? endif; ?>
                    </div>
                  </dd>
                </dl>
              </div>
            </div>
          </div>
        </div>
      </article>
    </div>
    <aside class="span3 sidebar" id="widgetarea-sidebar">
      <?/*?>
      <div id="search-2" class="widget widget_search">
        <form action="/search/" id="search-form">
          <div class="input-append">
            <input type="text" size="16" placeholder="Поиск&hellip;" name="s" id="s">
            <button type="submit" class="more">Поиск</button>
          </div>
        </form>
      </div>
      <?*/?>
      <? if ($recent_news->totalItemCount > 0): ?>
        <div id="recent-posts-2" class="widget widget_recent_entries">
          <h5 class="widget-title">Свежие записи</h5>
          <ul>
            <? foreach ($recent_news->getData() as $item): ?>
              <li>
                <a href="<?= $this->createUrl('/blog/item', array('id' => $item->id)) ?>"><?= $item->name ?></a>
              </li>
            <? endforeach; ?>
          </ul>
        </div>
      <? endif; ?>
      <div id="categories-2" class="widget widget_categories">
        <h5 class="widget-title">Рубрики</h5>
        <ul>
          <li class="cat-item cat-item-18"><a href="/blog/?tag=news">Новости</a></li>
          <li class="cat-item cat-item-17"><a href="<?= $this->createUrl('/blog/') ?>">Статьи</a></li>
        </ul>
      </div>
      <? if ($tags_list->totalItemCount > 0): ?>
        <div class="widget widget_tag_cloud">
          <h5 class="widget-title">Метки</h5>
          <div class="tagcloud">
            <? foreach ($tags_list->getData() as $tag_item): ?>
              <a href='/blog/?tag=<?= $tag_item->code ?>' style='font-size: 8pt;'><?= $tag_item->name ?></a>
            <? endforeach; ?>
          </div>
        </div>
      <? endif; ?>
    </aside>
  </div>
</div>