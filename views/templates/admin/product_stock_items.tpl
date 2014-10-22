<div id="" class="tab-pane">

	<ul id="items" class="list-unstyled">

		{foreach from=$htmlItems.productStocks item=item}

		<li id="item-{$item.id_prettypegs_stock_management|escape:'htmlall':'UTF-8'}" class="item well">

			<form method="post" action="{$htmlItems.postAction|escape:'htmlall':'UTF-8'}" enctype="multipart/form-data" class="item-form defaultForm  form-horizontal">

				<div class="btn-group pull-right">
					<button class="btn btn-default button-edit">
						<span class="button-edit-edit"><i class="icon-edit"></i>Update stock</span>
						<span class="button-edit-close hide"><i class="icon-remove"></i>Close</span>
					</button>
					<button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						<i class="icon-caret-down"></i>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="{$htmlItems.postAction|escape:'htmlall':'UTF-8'}&amp;removeItem&amp;item_id={$item.id_prettypegs_stock_management|escape:'htmlall':'UTF-8'}" name="removeItem" class="link-item-delete">
								<i class="icon-trash"></i>Delete item
							</a>
						</li>
					</ul>
				</div>

				<p><strong>ID: </strong>{$item.id_prettypegs_stock_management}</p>
				<p><strong>Name: </strong>{$item.name}</p>
				<p><strong>Reference: </strong>{$item.product_attribute_reference}</p>
				<p><strong>Quantity: </strong>{$item.quantity}</p>


				<div class="item-container clearfix" style="display:none;">

					<input type="hidden" name="item_id" value="{$item.id_prettypegs_stock_management|escape:'htmlall':'UTF-8'}" />


					<div class="html item-field form-group">
						<label class="control-label col-lg-3">add</label>
						<div class="col-lg-7">
							<input type="number" min="0" name="add" value="0">
						</div>
					</div>


					<div class="html item-field form-group">
						<label class="control-label col-lg-3">subtract</label>
						<div class="col-lg-7">
							<input type="number" min="0" name="subtract" value="0">
						</div>
					</div>

					<div class="form-group">
						<div class="col-lg-7 col-lg-offset-3">
							<button type="button" class="btn btn-default button-item-edit-cancel" >
								<i class="icon-remove"></i> Cancel
							</button>
							<button type="submit" name="updateItem" class="btn btn-success button-save pull-right" >
								<i class="icon-save"></i>Save
							</button>
						</div>
					</div>
				</div>

			</form>

		</li>

		{/foreach}

	</ul>
</div>