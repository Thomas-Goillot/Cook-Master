<?php
include_once('views/layout/dashboard/path.php');
?>


<?php

foreach ($certificates as $certificate) : ?>

    <div class="card">
        <div class="card-body">

            <h4 class="card-title d-inline-block mb-3"><i class="fas fa-chart-line"></i> Votre progression pour le certificat <?= $certificate['name'] ?></h4>

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