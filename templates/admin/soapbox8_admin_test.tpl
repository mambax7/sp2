<{if $testRows > 0}>
    <div class="outer">
        <form name="select" action="test.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value =='') {return false;} else if (window.document.select.op.value =='delete') {return deleteSubmitValid('testId[]');} else if (isOneChecked('testId[]')) {return true;} else {alert('<{$smarty.const._AM_TEST_SELECTED_ERROR}>'); return false;}">
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


            <table class="$test" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"/></th>
                    <th class="center"><{$selectorid}></th>
                    <th class="center"><{$selectortext}></th>
                    <th class="center"><{$selectortextarea}></th>
                    <th class="center"><{$selectordhtml}></th>
                    <th class="center"><{$selectorcheckbox}></th>
                    <th class="center"><{$selectorradioyn}></th>
                    <th class="center"><{$selectorselectbox}></th>
                    <th class="center"><{$selectorselectuser}></th>
                    <th class="center"><{$selectorcolorpicker}></th>
                    <th class="center"><{$selectoruploadimage}></th>
                    <th class="center"><{$selectoruploadfile}></th>
                    <th class="center"><{$selectortextdataselect}></th>
                    <th class="center"><{$selectordatetimeselect}></th>
                    <th class="center"><{$selectorarticleslink}></th>

                    <th class="center width5"><{$smarty.const._AM_SOAPBOX8_FORM_ACTION}></th>
                </tr>
                <{foreach item=testArray from=$testArrays}>
                    <tr class="<{cycle values="odd,even"}>">

                        <td align="center" style="vertical-align:middle;"><input type="checkbox" name="test_id[]" title="test_id[]" id="test_id[]" value="<{$testArray.test_id}>"/></td>
                        <td class='center'><{$testArray.id}></td>
                        <td class='center'><{$testArray.text}></td>
                        <td class='center'><{$testArray.textarea}></td>
                        <td class='center'><{$testArray.dhtml}></td>
                        <td class='center'><{$testArray.checkbox}></td>
                        <td class='center'><{$testArray.radioyn}></td>
                        <td class='center'><{$testArray.selectbox}></td>
                        <td class='center'><{$testArray.selectuser}></td>
                        <td class='center'><{$testArray.colorpicker}></td>
                        <td class='center'><{$testArray.uploadimage}></td>
                        <td class='center'><{$testArray.uploadfile}></td>
                        <td class='center'><{$testArray.textdataselect}></td>
                        <td class='center'><{$testArray.datetimeselect}></td>
                        <td class='center'><{$testArray.articleslink}></td>


                        <td class="center width5"><{$testArray.edit_delete}></td>
                    </tr>
                <{/foreach}>
            </table>
            <br>
            <br>
            <{else}>
            <table width="100%" cellspacing="1" class="outer">
                <tr>

                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"/></th>
                    <th class="center"><{$selectorid}></th>
                    <th class="center"><{$selectortext}></th>
                    <th class="center"><{$selectortextarea}></th>
                    <th class="center"><{$selectordhtml}></th>
                    <th class="center"><{$selectorcheckbox}></th>
                    <th class="center"><{$selectorradioyn}></th>
                    <th class="center"><{$selectorselectbox}></th>
                    <th class="center"><{$selectorselectuser}></th>
                    <th class="center"><{$selectorcolorpicker}></th>
                    <th class="center"><{$selectoruploadimage}></th>
                    <th class="center"><{$selectoruploadfile}></th>
                    <th class="center"><{$selectortextdataselect}></th>
                    <th class="center"><{$selectordatetimeselect}></th>
                    <th class="center"><{$selectorarticleslink}></th>

                    <th class="center width5"><{$smarty.const._AM_SOAPBOX8_FORM_ACTION}></th>
                </tr>
                <tr>
                    <td class="errorMsg" colspan="11">There are no $test</td>
                </tr>
            </table>
    </div>
    <br>
    <br>
<{/if}>
