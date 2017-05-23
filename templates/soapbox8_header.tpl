<div class="header">
    <span class="left"><b><{$smarty.const._MD_SOAPBOX8_TITLE}></b>&#58;&#160;</span>
    <span class="left"><{$smarty.const._MD_SOAPBOX8_DESC}></span><br>
</div>
<div class="head">
    <{if $adv != ''}>
        <div class="center"><{$adv}></div>
    <{/if}>
</div>
<table class="outer soapbox8" cellspacing="2" cellpadding="2">
    <thead>
    <tr class="center" colspan="2">
        <th><{$smarty.const._MD_SOAPBOX8_TITLE}> - <{$smarty.const._MD_SOAPBOX8_DESC}></th>
    </tr>
    </thead>
    <tbody>
    <tr class="center">
        <td class="center bold pad5">
            <ul class="menu center fields">
                <li><a href="<{$soapbox8_url}>"><{$smarty.const._MD_SOAPBOX8_INDEX}></a></li>

                <li> |</li>

                <li><a href="<{$soapbox8_url}>/sbcolumns.php"><{$smarty.const._MD_SOAPBOX8_SBCOLUMNS}></a></li>
                <li> |</li>

                <li><a href="<{$soapbox8_url}>/sbarticles.php"><{$smarty.const._MD_SOAPBOX8_SBARTICLES}></a></li>
                <li> |</li>

                <li><a href="<{$soapbox8_url}>/sbvotedata.php"><{$smarty.const._MD_SOAPBOX8_SBVOTEDATA}></a></li>
                <li> |</li>

                <li><a href="<{$soapbox8_url}>/test.php"><{$smarty.const._MD_SOAPBOX8_TEST}></a></li>
            </ul>
        </td>
    </tr>
    <{if $adv != ''}>
        <tr class="center">
            <td class="center bold pad5"><{$adv}></td>
        </tr>
    <{else}>
        <tr class="center">
            <td class="center bold pad5">&nbsp;</td>
        </tr>
    <{/if}>
    </tbody>
</table>
