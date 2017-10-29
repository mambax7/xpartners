<script type="text/javascript">
    var img_plus = "<{$xoops_url}>/modules/xpartners/assets/images/plus.gif";
    var img_minus = "<{$xoops_url}>/modules/xpartners/assets/images/minus.gif";
</script>
<script type="text/javascript" src="<{$xoops_url}>/modules/xpartners/assets/js/functions.js"></script>
<link rel="stylesheet" type="text/css" href="<{$xoops_url}>/modules/xpartners/assets/css/class.css">
<table id="xo-partners-data" class="outer" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <th class="width1"></th>
        <th><{$smarty.const._XO_AD_TITLE}></th>
        <th class="width5"><{$smarty.const._XO_AD_IMAGE}></th>
        <th class="width50"><{$smarty.const._XO_AD_DESCRIPTION}></th>
        <th><{$smarty.const._XO_AD_ACTIONS}></th>
    </tr>
    </thead>
    <tbody>
    <{foreach item=category from=$categories}>
        <tr class="even">
            <td>
                <img id="swap<{$category.id}>" class="cursorpointer" onclick="javascript:displayRowClass('xo-partners-data', 'child', <{$category.id}>);swapImg('swap<{$category.id}>');"
                     src="../assets/images/plus.gif" alt="">
            </td>
            <td colspan="3">
                <div class="bold"><{$category.name}></div>
                <div class="spacer"><{$category.desc}></div>
            </td>
            <td>
                <a href="partners.php?op=edit&amp;type=category&amp;id=<{$category.id}>"><img src="../assets/images/edit.png" alt=""></a>
                <a href="partners.php?op=delete&amp;type=category&amp;id=<{$category.id}>"><img src="../assets/images/delete.png" alt=""></a>
            </td>
        </tr>
        <{foreach item=partners from=$category.partners}>
            <tr class="child<{$category.id}>" style="display:none;">
                <td class="odd"></td>
                <td class="odd"><{$partners.title}></td>
                <td class="odd"><img src="<{$partners.image}>" alt=""></td>
                <td class="odd"><{$partners.description}></td>
                <td class="odd">

                    <a href="partners.php?op=toggle&amp;id=<{$partners.id}>&amp;status=<{$partners.status}>">
                        <img src="<{xoModuleIcons16}>/<{$partners.status}>.png"
                             title="<{$smarty.const._XO_AD_PARTNER_STATUS_TOGGLE}>"
                             alt="<{$smarty.const._XO_AD_PARTNER_STATUS_TOGGLE}>"></a>

                    <a href="partners.php?op=edit&amp;type=partners&amp;id=<{$partners.id}>"><img src="../assets/images/edit.png" title="<{$smarty.const._EDIT}>" alt=""></a>
                    <a href="partners.php?op=delete&amp;type=partners&amp;id=<{$partners.id}>"><img src="../assets/images/delete.png" title="<{$smarty.const._DELETE}>" alt=""></a>
                </td>
            </tr>
        <{/foreach}>
    <{/foreach}>
    </tbody>
</table>
