<?php

class PlanMaison
{
    public $fondation = 1;
    public $mur = 4;
    public $porte = 1;
    public $toit = 1;
    public $fenetre = 1;

    public function ajoutFondation()
    {
        $this->fondation++;
        $this->mur+=3;
        $this->porte++;
        $this->toit++;
        $this->fenetre++;
    }
}

$votreMaison = new PlanMaison();
$votreMaison->ajoutFondation();
print_r($votreMaison);


$votreMaison2 = new PlanMaison();
print_r($votreMaison2);
