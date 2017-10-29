<{include file='db:xpartners_header.tpl'}>
<table class="outer" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <th colspan="4"><{$smarty.const._XO_MD_TITLE}></th>
    </tr>
    </thead>
    <tbody>
    <{foreach item=category from=$categories}>
        <tr class="even">
            <td colspan="2" class="bold">
                <a href="index.php?cat_id=<{$category.id}>">
                    <{$category.name}>
                </a>
            </td>
            <td colspan="2"><{$category.desc}></td>
        </tr>
        <{foreach item=partners from=$category.partners}>
            <tr class="odd">
                <td class="width5">&nbsp;</td>
                <td class="width10">
                    <a onclick="addClick(<{$partners.id}>); return true;" href="<{$partners.url}>" rel="external" title="<{$partners.title}>">
                        <img src="<{$partners.image}>" alt=""><br><{$partners.title}>
                    </a>
                    <br>
                </td>
                <td><{$partners.description}></td>
                <td><{$partners.hits}></td>
            </tr>
        <{/foreach}>
    <{/foreach}>
    </tbody>
</table>
