formulaire new model
<section class="form">
    <form action="../controllers/c_newmodel.php" method="post">
        boucle input par champ

        <p>nom table : <input type="text" name="tablename" /></p>
        (id auto increment)
        <div id="column-container">

            <div class="actions">
                <button class="clone" onclick="clone()">Clone</button>
                <button class="remove" onclick="remove()">Remove</button>
            </div>
            <div id="clonedInput1" class="clonedInput">
                <p>
                    <label for="attribute">Attribute 1 : </label>
                    <input type="text" name="c1" value=""/>
                    <select class="slect-type" style="display:inline" name="type_1" id="type_1">
                        <option value="VARCHAR(255)" selected="">VARCHAR(255)</option>
                        <option value="TINYINT">TINYINT</option>
                        <option value="TEXT">TEXT</option>
                        <option value="DATE">DATE</option>
                        <option value="SMALLINT">SMALLINT</option>
                        <option value="MEDIUMINT">MEDIUMINT</option>
                        <option value="INT">INT</option>
                        <option value="BIGINT">BIGINT</option>
                        <option value="FLOAT">FLOAT</option>
                        <option value="DOUBLE">DOUBLE</option>
                        <option value="DECIMAL">DECIMAL</option>
                        <option value="DATETIME">DATETIME</option>
                        <option value="TIMESTAMP">TIMESTAMP</option>
                        <option value="TIME">TIME</option>
                        <option value="YEAR">YEAR</option>
                        <option value="CHAR(255)">CHAR(255)</option>
                        <option value="TINYBLOB">TINYBLOB</option>
                        <option value="TINYTEXT">TINYTEXT</option>
                        <option value="BLOB">BLOB</option>
                        <option value="MEDIUMBLOB">MEDIUMBLOB</option>
                        <option value="MEDIUMTEXT">MEDIUMTEXT</option>
                        <option value="LONGBLOB">LONGBLOB</option>
                        <option value="LONGTEXT">LONGTEXT</option>
                        <option value="BINARY">BINARY</option>
                        <option value="OTHER">OTHER...</option>
                        <option value="HASMANY">{ CHILD }</option>
                        <option value="BELONGSTO">{ PARENT }</option>
                        <option value="JOIN">{ SIBLING }</option>
                    </select>
                </p>
            </div>
        </div>
        <p><input type="submit" value="submit"></p>
    </form>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<!--<script>-->
<!--    jQuery("#addFields").submit(function(e){-->
<!--        e.preventDefault();-->
<!--    });-->
<!--</script>-->

Merci de créer vous même le SQL

