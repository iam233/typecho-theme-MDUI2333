<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div class="mdui-container">
	<div class="mdui-row">
		<div class="mdui-col-md-10 mdui-col-offset-md-1">
			<div class="mdui-card mdui-m-y-3">
				<div class="mdui-card-media">
					<div class="thumbnail" style="background:url(<?php ShowThumbnail($this); ?>);"></div>
					<div class="mdui-card-media-covered">
						<div class="mdui-card-primary">
							<div class="mdui-card-primary-title"><?php $this->title() ?></div>
						</div>
					</div>
				</div>
				<div class="mdui-card-actions">
					<div class="mdui-chip">
						<img class="mdui-chip-icon mdui-color-grey-200" src="<?php echo GravatarURL($this->author->mail,100); ?>" />
						<span class="mdui-chip-title"><a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a></span>
					</div>
					<div class="mdui-chip">
						<span class="mdui-chip-icon mdui-color-theme-accent"><i class="mdui-icon material-icons">&#xe8df;</i></span>
						<span class="mdui-chip-title"><a href="<?php $this->permalink(); ?>"><?php $this->date(); ?></a></span>
					</div>
					<div class="mdui-chip">
						<span class="mdui-chip-icon mdui-color-theme-accent"><i class="mdui-icon material-icons">&#xe5c3;</i></span>
						<span class="mdui-chip-title"><?php $this->category(','); ?></span>
					</div>
					<?php if (count($this->tags)>0){ ?>
					<div class="mdui-chip" mdui-menu="{target:'#posttag<?php echo $this->cid(); ?>',position:'top'}">
						<span class="mdui-chip-icon mdui-color-theme-accent"><i class="mdui-icon material-icons">&#xe54e;</i></span>
						<span class="mdui-chip-title">查看标签</span>
					</div>
					<ul class="mdui-menu" id="posttag<?php echo $this->cid(); ?>">
						<li class="mdui-menu-item mdui-ripple">
						<?php $this->tags('</li><li class="mdui-menu-item mdui-ripple">',true,''); ?>
						</li>
					</ul>
					<?php } ?>
					<div class="mdui-chip" id="commentsnumber">
						<span class="mdui-chip-icon mdui-color-theme-accent"><i class="mdui-icon material-icons">&#xe0b9;</i></span>
						<span class="mdui-chip-title"><a href="<?php $this->permalink(); ?>#comments"><?php $this->commentsNum('0 条评论', '1 条评论', '%d 条评论'); ?></a></span>
					</div>
					<?php if ($this->user->hasLogin()){ ?>
						<a href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid; ?>" target="_blank" class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple mdui-float-right mdui-hidden-sm-down" mdui-tooltip="{content:'编辑该文章',position:'right'}"><i class="mdui-icon material-icons">&#xe3c9;</i></a>
					<?php } ?>
				</div>
				<div class="mdui-divider"></div>
				<div class="mdui-card-content post-container" style="padding-left:4%;padding-right:4%;">
					<div class="mdui-typo">
		  				<?php echo RewriteContent($this->content); ?>
		  				<?php if ($this->options->copyright){ ?>
		  				<div class="mdui-card">
		  					<div class="mdui-card-content mdui-color-grey-50">
		  						<div><strong>本文链接：</strong><a href="<?php $this->permalink(); ?>"><?php $this->permalink(); ?></a></div>
		  						<div><strong>版权声明：</strong><?php echo $this->options->copyright; ?></div>
		  					</div>
		  				</div>
		  				<?php } ?>
					</div>
				</div>
				<div class="mdui-divider"></div>
				<?php $this->need('comments.php'); ?>
			</div>
		</div>
	</div>
</div>
<?php if ($this->options->posttoc=='true'){$content=$this->content;$havetoc=0;for ($i=1;$i<=6;$i++) $havetoc+=preg_match('/<h'.$i.'>(.*?)<\/h'.$i.'>/',$content);if ($havetoc>0){ ?>
<button class="mdui-hidden-xs-down mdui-fab mdui-fab-mini mdui-color-theme-accent mdui-ripple" id="post-tocbtn" style="position:fixed;top:72px;left:16px;z-index:1;border-radius:4px;" mdui-tooltip="{content:'文章目录',position:'right'}" mdui-menu="{target:'#post-toc',fixed:'true'}"><i class="mdui-icon material-icons">&#xe8de;</i></button>
<div class="mdui-menu" id="post-toc"></div>
<?php }} ?>
<?php if (!empty($this->options->posttimeouttext) && ($days=Countdays(date('Y-m-d',$this->modified),date('Y-m-d')))>=(empty($this->options->posttimeout)?180:$this->options->posttimeout)){ ?>
<script>mdui.snackbar({message:"本文写于 <?php echo Countdays($this->date->format('Y-m-d'),date('Y-m-d')); ?> 天前，最后更新于 <?php echo $days; ?> 天前。<br><?php echo $this->options->posttimeouttext; ?>",position:'right-bottom',timeout:0,buttonText:'OK'});</script>
<?php } ?>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>