<script>
  (function ($) {
    $('#task-tabs a').click(function (e) {
      e.preventDefault()
      $(this).tab('show')
    })
  })(jQuery);
</script>

<?php

/**
 * @file node.tpl.php
 *
 * Theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: Node body or teaser depending on $teaser flag.
 * - $picture: The authors picture of the node output from
 *   theme_user_picture().
 * - $date: Formatted creation date (use $created to reformat with
 *   format_date()).
 * - $links: Themed links like "Read more", "Add new comment", etc. output
 *   from theme_links().
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $submitted: themed submission information output from
 *   theme_node_submitted().
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $teaser: Flag for the teaser state.
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 */
?>
<div id="node-<?php print $node->nid; ?>" class="node<?php if ($sticky) { print ' sticky'; } ?><?php if (!$status) { print ' node-unpublished'; } ?> clear-block">

  <?php print $picture ?>

  <div class="well well-sm">

    <h4>

      <div class="task-badge pull-left">
        <span class="label label-default label-<?php print $task_label_class ?> task-status"><?php print $task_label ?></span>
      </div>

      <a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a>

      <?php if ($retry): ?>
        <div class="retry-button pull-right">
          <?php print $retry; ?>
        </div>
      <?php endif; ?>
    </h4>

    <p>
      <span class="duration">
          <i class="fa fa-clock-o"></i>
          <span class="duration-text">
            <?php print $duration; ?>
          </span>
      </span>
      <span>&nbsp;</span>
      <span class="executed inline">
          <i class="fa fa-calendar-o"></i>
          <?php print $date; ?>
          <small><?php print $executed; ?></small>
      </span>
    </p>

    <?php if ($site_url): ?>
      <?php print $site_url ?>
    <?php endif; ?>



    <?php if ($task_well): ?>
      <?php print $task_well; ?>
    <?php endif; ?>

  </div>

  <?php if (count($task_args)): ?>
    <div class="task-arguments well well-sm">
      <!-- Default panel contents -->

      <dl class="dl-horizontal">
        <dt><?php print t('Task Arguments') ?></dt>
        <dd>
        <?php foreach (array_filter($task_args) as $arg => $value): ?>
          <?php
          if ($value === '1') {
            $value = '';
            $arg = '<i class="fa fa-check"></i>' . $arg;
          }
          ?>
          <span class="task-arg small text-muted">
            <strong><?php print $arg; ?></strong>
            <span>
              <?php print $value; ?>
            </span>
          </span>
        <?php endforeach; ?>

        </dd>
      </dl>
    </div>
  <?php endif; ?>

    <?php  if ($follow_checkbox): ?>
        <div class="follow-logs-checkbox">
            <?php print $follow_checkbox; ?>
        </div>
    <?php endif; ?>

    <h3><?php print $type; ?></h3>

    <div id='task-logs'>
        <?php print $messages; ?>
    </div>

    <div class="running-indicator <?php print $is_active; ?>  text-muted small">
        <i class="fa fa-gear <?php print $is_running; ?>"></i> <span class="running-label"><?php print $running_label;?></span>
    </div>

    <?php print $content; ?>

    <div class="task-details">
        <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapseLogs" aria-expanded="false" aria-controls="collapseLogs">
            <i class="fa fa-list"></i> <?php print t('Details'); ?>
        </button>

        <?php if ($node->content['update-status']['#value']): ?>
            <?php print $node->content['update-status']['#value']; ?>
        <?php endif; ?>

        <div class="collapse" id="collapseLogs">
            <div class="well">
                <?php print $node->content['hosting_log']['#value']; ?>
            </div>
        </div>
    </div>

    <?php  if ($node->test_results_formatted): ?>
  <div role="tabpanel">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist" id="task-tabs">
      <li role="presentation" class="active"><a href="#task" aria-controls="task" role="tab" data-toggle="tab">
          <?php print t('Results'); ?>
        </a></li>
      <li role="presentation"><a href="#logs" aria-controls="logs" role="tab" data-toggle="tab">
          <?php print t('Details'); ?>
        </a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="task">
        <div class="padded-top">
          <div class="results-wrapper">
            <?php print $node->test_results_formatted; ?>
          </div>
          <label class="follow-checkbox btn btn-default"><input type="checkbox" id="follow"> Follow Logs</label>
        </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="logs">
        <div class="padded-top">
          <?php print $content; ?>
        </div>
      </div>
    </div>
  </div>

<?php endif; ?>

  <?php print $links; ?>
</div>