<{if $sbcolumnsRows > 0}>
    <div class="outer">
        <form name="select" action="sbcolumns.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value =='') {return false;} else if (window.document.select.op.value =='delete') {return deleteSubmitValid('sbcolumnsId[]');} else if (isOneChecked('sbcolumnsId[]')) {return true;} else {alert('<{$smarty.const._AM_SBCOLUMNS_SELECTED_ERROR}>'); return false;}">
            <input type="hidden" name="confirm" value="1"/>
            <div class="floatleft">
                <select name="op">
                    <option value=""><{$smarty.const._AM_SOAPBOX8_SELECT}></option>
                    <option value="delete"><{$smarty.const._AM_SOAPBOX8_SELECTED_DELETE}></option>
                </select>
                <input id="submitUp" class="formButton" type="submit" name="submitselect" value="<{$smarty.const._SUBMIT}>" title="<{$smarty.const._SUBMIT}>"/>
            </div>
            <div class="floatcenter0">
                <div id="pagenav"><{$pagenav}></div>
            </div>


            <table class="$sbcolumns" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"/></th>
                    <th class="center"><{$selectorcolumnID}></th>
                    <th class="center"><{$selectorauthor}></th>
                    <th class="center"><{$selectorname}></th>
                    <th class="center"><{$selectordescription}></th>
                    <th class="center"><{$selectortotal}></th>
                    <th class="center"><{$selectorweight}></th>
                    <th class="center"><{$selectorcolimage}></th>
                    <th class="center"><{$selectorcreated}></th>

                    <th class="center width5"><{$smarty.const._AM_SOAPBOX8_FORM_ACTION}></th>
                </tr>
                <{foreach item=sbcolumnsArray from=$sbcolumnsArrays}>
                    <tr class="<{cycle values="odd,even"}>">

                        <td align="center" style="vertical-align:middle;"><input type="checkbox" name="sbcolumns_id[]" title="sbcolumns_id[]" id="sbcolumns_id[]" value="<{$sbcolumnsArray.sbcolumns_id}>"/></td>
                        <td class='center'><{$sbcolumnsArray.columnID}></td>
                        <td class='center'><{$sbcolumnsArray.author}></td>
                        <td class='center'><{$sbcolumnsArray.name}></td>
                        <td class='center'><{$sbcolumnsArray.description}></td>
                        <td class='center'><{$sbcolumnsArray.total}></td>
                        <td class='center'><{$sbcolumnsArray.weight}></td>
                        <td class='center'><{$sbcolumnsArray.colimage}></td>
                        <td class='center'><{$sbcolumnsArray.created}></td>


                        <td class="center width5"><{$sbcolumnsArray.edit_delete}></td>
                    </tr>
                <{/foreach}>
            </table>
            <br>
            <br>
            <{else}>
            <table width="100%" cellspacing="1" class="outer">
                <tr>

                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"/></th>
                    <th class="center"><{$selectorcolumnID}></th>
                    <th class="center"><{$selectorauthor}></th>
                    <th class="center"><{$selectorname}></th>
                    <th class="center"><{$selectordescription}></th>
                    <th class="center"><{$selectortotal}></th>
                    <th class="center"><{$selectorweight}></th>
                    <th class="center"><{$selectorcolimage}></th>
                    <th class="center"><{$selectorcreated}></th>

                    <th class="center width5"><{$smarty.const._AM_SOAPBOX8_FORM_ACTION}></th>
                </tr>
                <tr>
                    <td class="errorMsg" colspan="11">There are no $sbcolumns</td>
                </tr>
            </table>
    </div>
    <br>
    <br>
<{/if}>
