<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
    <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <style>
        body {
            font-family: "Arial", sans-serif;
        }

        .bar {
            fill: #5f89ad;
        }

        .axis {
            font-size: 13px;
        }

        .axis path,
        .axis line {
            fill: none;
            display: none;
        }

        .label {
            font-size: 13px;
        }
    </style>


    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            font-size: 11px;
            font-weight: 300;
            fill: #242424;
            text-align: center;
            text-shadow: 0 1px 0 #fff, 1px 0 0 #fff, -1px 0 0 #fff, 0 -1px 0 #fff;
            cursor: default;
        }

        .legend {
            font-family: 'Raleway', sans-serif;
            fill: #333333;
        }

        .tooltip {
            fill: #333333;
        }
    </style>

    <select onchange="javascript:window.location.href='<?php echo base_url(); ?>MultiLanguageSwitcher/switcher/'+this.value;">
        <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
        <option value="dutch" <?php if($this->session->userdata('site_lang') == 'dutch') echo 'selected="selected"'; ?>>Dutch</option>
    </select>
</head>

<body>
<div id="graphic"></div>

<script>
    var data = [{"questions":"A1","score":3},{"questions":"A2","score":2},{"questions":"B1","score":4},{"questions":"B2","score":1},{"questions":"B3","score":5},{"questions":"B4","score":3},{"questions":"B5","score":4}
        ,{"questions":"C1","score":3},{"questions":"C2","score":4},{"questions":"C3","score":5}
        ,{"questions":"D1","score":3},{"questions":"D2","score":4},{"questions":"D3","score":1},{"questions":"D4","score":4},{"questions":"D5","score":5}
        ,{"questions":"E1","score":3},{"questions":"E2","score":4},{"questions":"E3","score":1},{"questions":"E4","score":4},{"questions":"E5","score":5}
        ,{"questions":"F1","score":3},{"questions":"F2","score":4},{"questions":"F3","score":5}
        ,{"questions":"G1","score":3},{"questions":"G2","score":4},{"questions":"G3","score":1},{"questions":"G4","score":4},{"questions":"G5","score":5},{"questions":"G6","score":4},{"questions":"G7","score":3}
        ,{"questions":"H1","score":3},{"questions":"H2","score":4},{"questions":"H3","score":1},{"questions":"H4","score":4},{"questions":"H5","score":5},{"questions":"H6","score":4}];

    // set the dimensions and margins of the graph
    var margin = {top: 20, right: 20, bottom: 30, left: 40},
        width = 500 - margin.left - margin.right,
        height = 500 - margin.top - margin.bottom;

    // set the ranges
    var y = d3.scaleBand()
        .range([height, 0])
        .padding(0.2);

    var x = d3.scaleLinear()
        .range([0, width]);

    // append the svg object to the body of the page
    // append a 'group' element to 'svg'
    // moves the 'group' element to the top left margin
    var svg = d3.select("#graphic").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform",
            "translate(" + margin.left + "," + margin.top + ")");
    // format the data
    data.forEach(function(d) {
        d.score = +d.score;
    });

    // Scale the range of the data in the domains
    x.domain([0, d3.max(data, function(d){ return d.score; })])
    y.domain(data.map(function(d) { return d.questions; }));


    // append the rectangles for the bar chart
    svg.selectAll(".bar")
        .data(data)
        .enter().append("rect")
        .attr("class", "bar")

        .attr("width", function(d) {return x(d.score); } )
        .attr("y", function(d) { return y(d.questions); })
        .attr("height", y.bandwidth());

    // add the x Axis
    svg.append("g")
        .attr("transform", "translate(0," + height + ")")
        .call(d3.axisBottom(x));

    // add the y Axis
    svg.append("g")
        .call(d3.axisLeft(y));

    svg.axis()
        .tickFormat(d3.format(""));

</script>

<h3><?php echo $this->lang->line('title'); ?></h3>


<table align="center" cellpadding = "10">
    <tr>
        <td><?php echo $this->lang->line('first'); ?></td>
        <td><input type="text" name="firstname" maxlength="30"/>
        </td>
    </tr>

    <tr>
        <td><?php echo $this->lang->line('last'); ?></td>
        <td><input type="text" name="name" maxlength="30"/>
        </td>
    </tr>

    <tr>
        <td><?php echo $this->lang->line('birth'); ?></td>

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
        <td><?php echo $this->lang->line('room'); ?></td>
        <td><input type="text" name="Room_Id" maxlength="100" /></td>
    </tr>
    <tr>
        <td><?php echo $this->lang->line('bed'); ?></td>
        <td><input type="text" name="Bed_Id" maxlength="10" /></td>
    </tr>

   <!--<tr>
        <td>EMAIL</td>
        <td>
            <input type="text" name="email" maxlength="30" />
        </td>
    </tr>-->

   <!-- <tr>
        <td>PASSWORD</td>
        <td>
            <input type="text" name="password" maxlength="30" />
        </td>
    </tr>-->

    <tr>
        <td><?php echo $this->lang->line('contact'); ?></td>
        <td>
            <input type="text" name="Mobile_Number" maxlength="10" />
        </td>
    </tr>

    <!--<tr>
        <td>GENDER</td>
        <td>
            Male <input type="radio" name="Gender" value="Male" />
            Female <input type="radio" name="Gender" value="Female" />
        </td>
    </tr>-->

    <tr>
        <td>PIN CODE</td>
        <td><input type="text" name="Pin_Code" maxlength="6" />
        </td>
    </tr>


   <!-- <tr>
        <td>NATIONALITY</td>
        <td><input type="text" name="Nationality" value="Belgium" readonly="readonly" /></td>
    </tr>-->

    <tr>
        <br/>
        <td><?php echo $this->lang->line('language'); ?></td>
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
        <td><?php echo $this->lang->line('floor'); ?></td>
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
        <td><?php echo $this->lang->line('preferences'); ?></td>
        <td>
            <input type="text" name="Preferences" maxlength="200" />
        </td>
    </tr>
    <tr>
        <td><?php echo $this->lang->line('privileges'); ?></td>
        <td>
            <input type="text" name="Mobile_Number" maxlength="200" />
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