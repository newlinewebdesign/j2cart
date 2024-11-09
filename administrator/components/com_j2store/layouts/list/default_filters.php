<?php
/**
 * @package J2Store
 * @copyright Copyright (c)2014-17 Ramesh Elamathi / J2Store.org
 * @copyright Copyright (c) 2024 J2Commerce . All rights reserved.
 * @license GNU GPL v3 or later
 */


// No direct access to this file
defined('_JEXEC') or die('Restricted access');
use Joomla\CMS\Language\Text;


$row_class = 'row';
$col_class = 'col-md-';
if (version_compare(JVERSION, '3.99.99', 'lt')) {
    $row_class = 'row-fluid';
    $col_class = 'span';
}
?>
<?php if(isset($vars->header) && !empty($vars->header)):?>
	<?php $sortable_field = array();?>
    <div class="btn-toolbar w-100 justify-content-end mb-3">
        <?php foreach ($vars->header as $name => $field):
            if(isset($field['sortable']) && $field['sortable'] === 'true'){
                $sortable_field[$name] = Text::_($field['label']);
            } ?>
            <?php if(isset($field['type']) && $field['type'] === 'fieldsearchable'):?>
                <div class="filter-search-bar btn-group flex-grow-1 flex-lg-grow-0 mb-2 mb-lg-0">
                    <div class="input-group w-100 searchable_field">
                        <input id="search_<?php echo $name;?>" type="text" name="<?php echo $name;?>" value="<?php echo $vars->state->get($name,'');?>" placeholder="<?php echo Text::_($field['label'])?>" class="form-control j2store-product-filters">
                        <span class="filter-search-bar__label visually-hidden">
                            <label id="search-lbl" for="search"><?php echo Text::_($field['label'])?></label>
                        </span>
                        <button type="button" class="btn btn-primary" onclick="document.adminForm.submit()"><span class="filter-search-bar__button-icon icon-search" aria-hidden="true"></span></button>
                        <button type="button" class="btn btn-primary" onclick="document.adminForm.<?php echo $name;?>.value='';document.adminForm.submit()"><?php echo Text::_( 'JCLEAR' );?></button>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

        <div class="ordering-select d-flex gap-2 ms-lg-2 flex-grow-1 flex-lg-grow-0">
	        <?php if(!empty($sortable_field)):?>
                <select id="directionTable" class="form-select j2store-product-filters w-100" name="sortTable" onchange="jQuery('#filter_order_Dir').val(this.value);this.form.submit();">
                    <option value=""><?php echo Text::_('JFIELD_ORDERING_LABEL');?></option>
                    <option value="asc" <?php echo $vars->state->filter_order_Dir == 'asc' ? 'selected="selected"': '';?>><?php echo Text::_('JGLOBAL_ORDER_ASCENDING');?></option>
                    <option value="desc" <?php echo $vars->state->filter_order_Dir == 'desc' ? 'selected="selected"': '';?>><?php echo Text::_('JGLOBAL_ORDER_DESCENDING');?></option>
                </select>
                <select id="sortTable" class="form-select j2store-product-filters w-100" name="sortTable" onchange="jQuery('#filter_order').val(this.value);this.form.submit();">
                    <option value=""><?php echo Text::_('JGLOBAL_SORT_BY');?></option>
			        <?php foreach ($sortable_field as $filter_name => $filter_value): ?>
				        <?php if($vars->state->filter_order == $filter_name):?>
                            <option value="<?php echo $filter_name;?>" selected="selected"><?php echo $filter_value;?></option>
				        <?php else: ?>
                            <option value="<?php echo $filter_name;?>"><?php echo $filter_value;?></option>
				        <?php endif; ?>
			        <?php endforeach; ?>
                </select>
	        <?php endif; ?>
	        <?php echo $vars->pagination->getLimitBox();?>
        </div>
    </div>
<?php endif; ?>
