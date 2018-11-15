<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Custom CSS-->
</head>
<body>
<div class="container">


    <div class="row">
        <div class="col-3 border-left border-top">
        </div>
        <div class="col-7 border-left border-top border-right">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-questionnaire-tab" data-toggle="tab" href="#nav-Questionnaire" role="tab" aria-controls="nav-Questionnaire" aria-selected="true">Questionnaire</a>
                    <a class="nav-item nav-link" id="nav-poll-tab" data-toggle="tab" href="#nav-Poll" role="tab" aria-controls="nav-Poll" aria-selected="false">Poll</a>
                    <a class="nav-item nav-link" id="nav-personal-tab" data-toggle="tab" href="#nav-Personal" role="tab" aria-controls="nav-Personal" aria-selected="false">Personal</a>
                </div>
            </nav>
        </div>
        <div class="col-2 border-right border-top">
        </div>


    </div>



    <div class="row">
        <div class="col-3 border-bottom border-left">
            <h5>notes about Jan</h5>
            <button type="button" class="btn btn-light">add</button>
            <div class="accordion" id="accordionNotes">
                <div class="card">
                    <div class="card-header" id="headingToday">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseToday" aria-expanded="true" aria-controls="collapseToday">
                                Today
                            </button>
                        </h5>
                    </div>

                    <div id="collapseToday" class="collapse show" aria-labelledby="headingToday" data-parent="#accordionNotes">
                        <div class="card-body">
                            Today's notes go here...
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingWeek">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseWeek" aria-expanded="false" aria-controls="collapseWeek">
                                This week
                            </button>
                        </h5>
                    </div>
                    <div id="collapseWeek" class="collapse" aria-labelledby="headingWeek" data-parent="#accordionNotes">
                        <div class="card-body">
                            This weeks notes go here...
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingAll">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseAll" aria-expanded="false" aria-controls="collapseAll">
                                Archive
                            </button>
                        </h5>
                    </div>
                    <div id="collapseAll" class="collapse" aria-labelledby="headingAll" data-parent="#accordionNotes">
                        <div class="card-body">
                            The notes archive goes here...
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-7 border-bottom border-left border-right">
            <nav>
                <!--<div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-questionnaire-tab" data-toggle="tab" href="#nav-Questionnaire" role="tab" aria-controls="nav-Questionnaire" aria-selected="true">Questionnaire</a>
                    <a class="nav-item nav-link" id="nav-poll-tab" data-toggle="tab" href="#nav-Poll" role="tab" aria-controls="nav-Poll" aria-selected="false">Poll</a>
                    <a class="nav-item nav-link" id="nav-personal-tab" data-toggle="tab" href="#nav-Personal" role="tab" aria-controls="nav-Personal" aria-selected="false">Personal</a>
                </div>-->
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-Questionnaire" role="tabpanel" aria-labelledby="nav-Questionnaire-tab">
                    <div class="accordion" id="accordionQuestionnaire">
                        <div class="card">
                            <div class="card-header" id="headingProfile">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseProfile" aria-expanded="true" aria-controls="collapseProfile">
                                        Jan's profile
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseProfile" class="collapse show" aria-labelledby="headingProfile" data-parent="#accordionQuestionnaire">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingOutliers">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseOutliers" aria-expanded="false" aria-controls="collapseOutliers">
                                        Outliers
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOutliers" class="collapse" aria-labelledby="headingOutliers" data-parent="#accordionQuestionnaire">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingAnswers">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseAnswers" aria-expanded="false" aria-controls="collapseAnswers">
                                        Full answers
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseAnswers" class="collapse" aria-labelledby="headingAnswers" data-parent="#accordionQuestionnaire">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-Poll" role="tabpanel" aria-labelledby="nav-Poll-tab">Poll</div>
                <div class="tab-pane fade" id="nav-Personal" role="tabpanel" aria-labelledby="nav-contact-tab">Personal</div>
            </div>
        </div>
        <div class="col-2 border-bottom border-right">
            <h5>floor</h5>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    floor
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuFloor">
                    <button class="dropdown-item" type="button">1</button>
                    <button class="dropdown-item" type="button">2</button>
                    <button class="dropdown-item" type="button">3</button>
                    <button class="dropdown-item" type="button">4</button>
                    <button class="dropdown-item" type="button">5</button>
                    <button class="dropdown-item" type="button">6</button>
                </div>
            </div>
            <h5>Person</h5>
            <input type="search" class="form-control ds-input" id="search-input" placeholder="Search..." autocomplete="off" spellcheck="false" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-owns="algolia-autocomplete-listbox-0" style="position: relative; vertical-align: top;" dir="auto">
            <div class="btn-group-vertical" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-light">Jan</button>
                <button type="button" class="btn btn-light">Maria</button>
                <button type="button" class="btn btn-light">Jef</button>
                <button type="button" class="btn btn-light">Rene</button>
                <button type="button" class="btn btn-light">Marie-Jean</button>
            </div>
        </div>
    </div>
</div>





<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<a href="<?= site_url('Caregiver_controller/login') ?>">Logout</a>
</body>
</html>