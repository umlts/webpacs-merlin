<!--{msg}-->
        
        <div id="accessibleForm" class="advancedSearch">
        
<!--{advancedsearchformbegin}-->

        <div class="limits">
        <div class="limitColumn">
        <label> <input name="searchtype" class="searchtype" value="X" checked="checked" type="radio"> Keyword </label> 
        <label> <input name="searchtype" class="searchtype" value="t" type="radio"> Title begins with </label>
        </div>
        <div class="limitColumn">
        <label> <input name="searchtype" class="searchtype" value="s" type="radio"> Journal & Newspapers title begins with </label>
        <label> <input name="searchtype" class="searchtype" value="a" type="radio"> Author (last name first) </label>
        </div>
        </div>
        
        <div class="formEntryArea">
        <input type="hidden" name="fieldLimit1" value="" />
        <input maxlength="75" size="35" name="searchText1" />
<!--{scope}-->
        </div>
        <input type="hidden" name="startLimit" >
        <div class="formEntryArea">
<!--{availlim}-->
        </div>
        <div class="formButtonArea">
        <span>
<!--{advancedsubmit}-->
        </span>
        <span>
<!--{clearform}-->
        </span>
        </div>
        
        
        <fieldset>
        <legend>Add Limits (Optional)</legend>
        
        <div class="formEntryArea">
<!--{DOCDATE}-->
        </div>
        
        <div class="formEntryArea">
        <table border="0">
        <tr><td><label for="n">Online:</label></td><td><select id="n" name="n">
        <option value="">ANY</option>
        <option value="cr">Online Only</option>
        </select>
        </td>
        </tr></table>
        </div>
        
            <!--{govdoc}-->
            
        <div class="formEntryArea">
<!--{lang}-->
        </div>
        
        <div class="formEntryArea">
<!--{branch}-->
        </div>
        
        <div class="formEntryArea">
        <table border="0">
        <tr><td><label for="a">Audio and Video Formats:</label></td><td><select id="a" name="a" size="5" multiple="multiple">
        <option value="">ANY</option>
        <option value=""></option>
        <option value="s*">AUDIO FORMATS</option>
        <option value="s*">All Sound Recording Formats</option>
        <option value="ss">Audio cassettes</option>
        <option value="sd f">CDs</option>
        <option value="sd b">LPs</option>
        <option value="sd c">45 rpm </option>
        <option value="sd d">78 rpm</option>
        <option value="sd z">DVD-audio</option>
        <option value="st">Reel-to-reel</option>
        <option value="se">Cylinder</option>
        <option value="sq">Roll</option>
        <option value="sw">Wire recording</option>
        <option value=""></option>
        <option value="v*">VIDEO FORMATS</option>
        <option value="v*">All Video Recording Formats</option>
        <option value="vd">DVD-video</option>
        <option value="vf">VHS</option>
        <option value="mr">16/35 mm film</option>
        </select>
        </td>
        </tr></table>
        </div>
        
        
        <div class="formEntryArea">
<!--{mattype}-->
        </div>
        
        
        <div class="formEntryArea">
<!--{publish}-->
        </div>
        
        </fieldset>
        <input type="hidden" name="endLimit" >
        
<!--{advancedsearchformend}-->
        </div> <!-- form3Part -->
        
        
        <p><strong>Search tips for Keyword Search</strong></p>
          <p>Use keywords from the title, author, subjects or notes.</p>
          <p><em>Examples:</em></p>
          <ul>
            <li><em>evolution and altruism</em></li>
            <li><em>&quot;achievement test&quot;</em></li>
          </ul>
          <p>For more options, use an Advanced Search. </p>
        </div