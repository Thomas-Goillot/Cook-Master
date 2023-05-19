<?php
include_once('views/layout/dashboard/path.php');
?>

<div class="card">
    <div class="card-body">

        <h4 class="card-title d-inline-block mb-3"><i class="fas fa-chart-line"></i> Votre progression pour le certificat "aziencizenci"</h4>
        <ol class="ProgressBar">
            <li class="ProgressBar-step is-complete">
                <svg class="ProgressBar-icon">
                    <use xlink:href="#checkmark-bold" />
                </svg>
                <span class="ProgressBar-stepLabel">Test</span>
            </li>
            <li class="ProgressBar-step is-current">
                <svg class="ProgressBar-icon">
                    <use xlink:href="#checkmark-bold" />
                </svg>
                <span class="ProgressBar-stepLabel">Test1</span>
            </li>
            <li class="ProgressBar-step">
                <svg class="ProgressBar-icon">
                    <use xlink:href="#checkmark-bold" />
                </svg>
                <span class="ProgressBar-stepLabel">Test2</span>
            </li>
            <li class="ProgressBar-step">
                <svg class="ProgressBar-icon">
                    <use xlink:href="#checkmark-bold" />
                </svg>
                <span class="ProgressBar-stepLabel">Test3</span>
            </li>
            <li class="ProgressBar-step">
                <svg class="ProgressBar-icon">
                    <use xlink:href="#checkmark-bold" />
                </svg>
                <span class="ProgressBar-stepLabel">Test4</span>
            </li>
            <li class="ProgressBar-step">
                <svg class="ProgressBar-icon">
                    <use xlink:href="#checkmark-bold" />
                </svg>
                <span class="ProgressBar-stepLabel">Test5</span>
            </li>
            <li class="ProgressBar-step">
                <svg class="ProgressBar-icon">
                    <use xlink:href="#checkmark-bold" />
                </svg>
                <span class="ProgressBar-stepLabel">Test6</span>
            </li>
            

        </ol>
        <!--
Apply .is-current to a list item note the current step in the list. Apply .is-complete to show the checkmark. The line will be drawn when two list items marked with either class sit next to each other.-->
    </div>
</div>