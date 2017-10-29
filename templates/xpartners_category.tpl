<{include file='db:xpartners_header.tpl'}>
<table class="outer" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <th colspan="4"><{$smarty.const._XO_MD_TITLE}></th>
    </tr>
    </thead>
    <tbody>
    <{foreach item=partner from=$list}>
        <tr class="odd">
            <td class="width5">&nbsp;</td>
            <td class="width10">
                <a onclick="addClick(<{$partner.id}>); return true;" href="<{$partner.url}>" rel="external" title="<{$partner.title}>">
                    <img src="<{$partner.image}>" alt=""><br><{$partner.title}>
                </a>
                <br>
            </td>
            <td><{$partner.description}></td>
            <td><{$partner.hits}></td>
        </tr>
    <{/foreach}>
    </tbody>
</table>
