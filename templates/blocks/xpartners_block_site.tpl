<script type="text/javascript">
    // Create ticker at domready state
    window.addEvent('domready', function () {
        var myTicker = new mooTicker($(document.body).getElement('.newsticker'), {groupBy: 1, interval: 5000});
    });
</script>
<ul id="newsticker" class="newsticker">
    <li><!-- DO NOT REMOVE --></li>
    <{foreach item=partner from=$block}>
        <li class="txtcenter">
            <a onclick="addClick(<{$partner.id}>); return true;" href="<{$partner.url}>" rel="external" title="<{$partner.title}>">
                <img src="<{$partner.image}>" alt="<{$partner.title}>"><br><{$partner.title}>
            </a>
        </li>
    <{/foreach}>
</ul>
