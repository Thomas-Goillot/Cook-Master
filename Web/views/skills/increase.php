<?php
include_once('views/layout/dashboard/path.php');
?>

<?php
if(empty($certificates)){
    echo '<div class="alert alert-info" role="alert">
            Vous n\'avez pas encore de certificat
        </div>';
}

foreach ($certificates as $certificate) : ?>

    <div class="card">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title d-inline-block mb-3"><i class="fas fa-chart-line"></i> Votre progression pour le certificat <?= $certificate['name'] ?></h4>
                <?php if($certificate['isComplete']){
                    echo '<a href="'.$path_prefix.'SkillsUsers/download/'.$certificate['id_certificate'].'" class="btn btn-primary">Télécharger le certificat</a>';
                }
                ?>
            </div>

            <ol class="ProgressBar">
                <?php foreach ($certificate['skills'] as $skill) : ?>
                    <?php 
                        foreach ($validatedSkills as $validatedSkill) {
                            if ($validatedSkill['id_skills'] == $skill['id_skills'] && in_array($certificate['id_certificate'], $validatedSkill['id_certificate'])) {
                                $isComplete = true;
                                break;
                            } else {
                                $isComplete = false;
                            }
                        }
                    ?>

                    <li class="ProgressBar-step <?= $isComplete ? 'is-complete' : '' ?>">
                        <svg class="ProgressBar-icon">
                            <use xlink:href="#checkmark-bold" />
                        </svg>
                        <span class="ProgressBar-stepLabel"><?= $skill['name'] ?></span>
                    </li>

                <?php endforeach; ?>
            </ol>



        </div>
    </div>

<?php endforeach; ?>