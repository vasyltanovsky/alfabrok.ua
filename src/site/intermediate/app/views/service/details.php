<table class="TableCatalogPage" cellpadding="0" cellspacing="0">
	<tr>
		<td class="TCTdList">
			<h1 class="TitleCatalog"><?php echo $Data ["title"]?></h1>
			<table class="TableInfo" border="0" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
						<td class="TableInfoTdImage"><img src="<?php echo getLangString ( "imageDomain" )?><?php echo getLangString('imageDomain');?>/files/images/service/<?php echo $Data ['img']?>" alt="<?php echo $Data ['title']?>"></td>
						<td class="TableInfoTdDescription">
						<div class="DivTableCP">
						<div><?php
						echo $Data ["summary"]?></div>
						</div>
						</td>
					</tr>
				</tbody>
			</table>
		</td>
		<td><?php echo appHtmlClass::partialAction("immovables", "partialListHot", array( "cashe" => 1 )); ?></td>
	</tr>
</table>