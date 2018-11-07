<div class="container-fluid goods">
    <div class="row">
        <div class="col-xl-4">
            <!-- список категорий #TODO перемещение элемента при минимальной ширине -->
            <div id="categories" class="row dropdown-content-categories">
                <ul>
                    <li>категория 1</li>
                    <li>категория 2</li>
                    <li>категория 3</li>
                    <li>категория 4</li>
                    <li>категория 5</li>
                </ul>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="row">
                <?php
                    for ($i=1; $i<49; $i++){
                        echo "<div class=\"good col-12 col-md-4 col-xl-3\">good $i</div>";
                    }
                ?>
            </div>
        </div>
    </div>
</div>