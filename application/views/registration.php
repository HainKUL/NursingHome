<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
    <title>Elderly Registration Form</title>
    <link rel="icon" href="<?=base_url()?>assets/photos/favicon.png" type="image/gif" sizes="16x16">

    <link href="<?=base_url() ?>assets/css/password_forgot.css" rel="stylesheet" type="text/css"/>
    <select onchange="javascript:window.location.href='<?php echo base_url(); ?>MultiLanguageSwitcher/switcher/'+this.value;">
        <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
        <option value="dutch" <?php if($this->session->userdata('site_lang') == 'dutch') echo 'selected="selected"'; ?>>Dutch</option>
    </select>
</head>

<body>
<h3>ELDERLY REGISTRATION FORM</h3>

<table align="center" cellpadding = "10">
registration.php
    <tr>
        <td>FIRST NAME</td>
        <td><input type="text" name="firstname" maxlength="30"/>
        </td>
    </tr>

    <tr>
        <td>LAST NAME</td>
        <td><input type="text" name="name" maxlength="30"/>
        </td>
    </tr>

    <tr>
        <td>DATE OF BIRTH</td>

        <td>
            <select name="Birthday_day" id="Birthday_Day">
                <option value="-1">Day:</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>

                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>

                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>

                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>

                <option value="31">31</option>
            </select>

            <select id="Birthday_Month" name="Birthday_Month">
                <option value="-1">Month:</option>
                <option value="January">Jan</option>
                <option value="February">Feb</option>
                <option value="March">Mar</option>
                <option value="April">Apr</option>
                <option value="May">May</option>
                <option value="June">Jun</option>
                <option value="July">Jul</option>
                <option value="August">Aug</option>
                <option value="September">Sep</option>
                <option value="October">Oct</option>
                <option value="November">Nov</option>
                <option value="December">Dec</option>
            </select>

            <select name="Birthday_Year" id="Birthday_Year">

                <option value="-1">Year:</option>
                <option value="1990">1990</option>

                <option value="1989">1989</option>
                <option value="1988">1988</option>
                <option value="1987">1987</option>
                <option value="1986">1986</option>
                <option value="1985">1985</option>
                <option value="1984">1984</option>
                <option value="1983">1983</option>
                <option value="1982">1982</option>
                <option value="1981">1981</option>
                <option value="1980">1980</option>

                <option value="1979">1979</option>
                <option value="1978">1978</option>
                <option value="1977">1977</option>
                <option value="1976">1976</option>
                <option value="1975">1975</option>
                <option value="1974">1974</option>
                <option value="1973">1973</option>
                <option value="1972">1972</option>
                <option value="1971">1971</option>
                <option value="1970">1970</option>

                <option value="1969">1969</option>
                <option value="1968">1968</option>
                <option value="1967">1967</option>
                <option value="1966">1966</option>
                <option value="1965">1965</option>
                <option value="1964">1964</option>
                <option value="1963">1963</option>
                <option value="1962">1962</option>
                <option value="1961">1961</option>
                <option value="1960">1960</option>

                <option value="1959">1959</option>
                <option value="1958">1958</option>
                <option value="1957">1957</option>
                <option value="1956">1956</option>
                <option value="1955">1955</option>
                <option value="1954">1954</option>
                <option value="1953">1953</option>
                <option value="1952">1952</option>
                <option value="1951">1951</option>
                <option value="1950">1950</option>

                <option value="1949">1949</option>
                <option value="1948">1948</option>
                <option value="1947">1947</option>
                <option value="1946">1946</option>
                <option value="1945">1945</option>
                <option value="1944">1944</option>
                <option value="1943">1943</option>
                <option value="1942">1942</option>
                <option value="1941">1941</option>
                <option value="1940">1940</option>

                <option value="1939">1939</option>
                <option value="1938">1938</option>
                <option value="1937">1937</option>
                <option value="1936">1936</option>
                <option value="1935">1935</option>
                <option value="1934">1934</option>
                <option value="1933">1933</option>
                <option value="1932">1932</option>
                <option value="1931">1931</option>
                <option value="1930">1930</option>

                <option value="1929">1929</option>
                <option value="1928">1928</option>
                <option value="1927">1927</option>
                <option value="1926">1926</option>
                <option value="1925">1925</option>
                <option value="1924">1924</option>
                <option value="1923">1923</option>
                <option value="1922">1922</option>
                <option value="1921">1921</option>
                <option value="1920">1920</option>

                <option value="1919">1919</option>
                <option value="1918">1918</option>
            </select>
        </td>
    </tr>

    <tr>
        <td>ROOM ID</td>
        <td><input type="text" name="Room_Id" maxlength="100" /></td>
    </tr>

    <tr>
        <td>EMAIL</td>
        <td>
            <input type="text" name="email" maxlength="30" />
        </td>
    </tr>

    <tr>
        <td>PASSWORD</td>
        <td>
            <input type="text" name="password" maxlength="30" />
        </td>
    </tr>

    <tr>
        <td>MOBILE NUMBER</td>
        <td>
            <input type="text" name="Mobile_Number" maxlength="10" />
        </td>
    </tr>

    <tr>
        <td>GENDER</td>
        <td>
            Male <input type="radio" name="Gender" value="Male" />
            Female <input type="radio" name="Gender" value="Female" />
        </td>
    </tr>

    <tr>
        <td>HOME ADDRESS <br /><br /><br /></td>
        <td><textarea name="Address" rows="4" cols="30"></textarea></td>
    </tr>

    <tr>
        <td>HOMEDOWN</td>
        <td><input type="text" name="City" maxlength="30" />
        </td>
    </tr>

    <tr>
        <td>PIN CODE</td>
        <td><input type="text" name="Pin_Code" maxlength="6" />
        </td>
    </tr>

    <tr>
        <td>PROVINCE</td>
        <td><input type="text" name="Province" maxlength="30" />
        </td>
    </tr>

    <tr>
        <td>NATIONALITY</td>
        <td><input type="text" name="Nationality" value="Belgium" readonly="readonly" /></td>
    </tr>

    <tr>
        <br/>
        <td>LANGUAGE PREFERENCE</td>
        <td>
            Dutch
            <input type="radio" name="Dutch" value="Dutch">
            English
            <input type="radio" name="English" value="English">
            French
            <input type="radio" name="French" value="French">
        </td>
    </tr>

    <tr>
        <td>FLOOR</td>
        <td>
            GroundFloor
            <input type="radio" name="GroundFloor" value="GroundFloor">
            FirstFloor
            <input type="radio" name="FirstFloor" value="FirstFloor">
            SecondFloor
            <input type="radio" name="SecondFloor" value="SecondFloor">
            ThirdFloor
            <input type="radio" name="ThirdFloor" value="ThirdFloor">
        </td>
    </tr>

    <tr>
        <td colspan="2" align="center">
            <input type="submit" value="Save">
            <input type="reset" value="Reset">
        </td>
    </tr>
</table>


</body>
</html>