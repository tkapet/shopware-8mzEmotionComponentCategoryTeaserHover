{block name="widget_emotion_component_category_teaser_hover_effect_panel"}
	{if $Data}
		<div class="emotion--category-teaser box">

			{* Category teaser image *}
			{block name="widget_emotion_component_category_teaser_hover_effect_image"}
				{if isset($Data.media)}
					{$media = $Data.media}
				{else}
					{$media = $Data.image}
				{/if}

				{$images = $media.thumbnails}
			{/block}

			{* Category teaser lnk *}
			{block name="widget_emotion_component_category_teaser_hover_effect_link"}

				{if $Data.blog_category}
					{$url = "{url controller=blog action=index sCategory=$Data.category_selection}"}
				{else}
					{$url = "{url controller=cat action=index sCategory=$Data.category_selection}"}
				{/if}

        {if $Data.link_address}
          {$url = $Data.link_address}
        {/if}

        {if $Data.link_text}
          {$title = $Data.link_text}
        {else}
          {$title = $Data.categoryName}
        {/if}

				{strip}
					<style type="text/css">

						#teaser--{$Data.objectId} {
							background-image: url('{$images[0].source}');
						}

						{if isset($images[0].retinaSource)}
						@media screen and (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
							#teaser--{$Data.objectId} {
								background-image: url('{$images[0].retinaSource}');
							}
						}
						{/if}

						@media screen and (min-width: 48em) {
							#teaser--{$Data.objectId} {
								background-image: url('{$images[1].source}');
							}
						}

						{if isset($images[1].retinaSource)}
						@media screen and (min-width: 48em) and (-webkit-min-device-pixel-ratio: 2),
						screen and (min-width: 48em) and (min-resolution: 192dpi) {
							#teaser--{$Data.objectId} {
								background-image: url('{$images[1].retinaSource}');
							}
						}
						{/if}

						@media screen and (min-width: 78.75em) {
							.is--fullscreen #teaser--{$Data.objectId} {
								background-image: url('{$images[2].source}');
							}
						}

						{if isset($images[2].retinaSource)}
						@media screen and (min-width: 78.75em) and (-webkit-min-device-pixel-ratio: 2),
						screen and (min-width: 78.75em) and (min-resolution: 192dpi) {
							.is--fullscreen #teaser--{$Data.objectId} {
								background-image: url('{$images[2].retinaSource}');
							}
						}
						{/if}
					</style>
				{/strip}
				<figure id="teaser--{$Data.objectId}" class="effect-{$Data.hover_effect[0].effect}">
					<figcaption>
						<div>
							<h2 style="color: {$Data.title_color}">{$title}</h2>
							<p style="color: {$Data.description_color}">{$Data.description_text}</p>
						</div>
            <a href="{$url}"></a>
					</figcaption>
				</figure>
			{/block}
		</div>
	{/if}
{/block}
