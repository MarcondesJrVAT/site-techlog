<?php

namespace Controllers;

class Home extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = SITETITLE;
        $this->renderSite('home', $data);
    }

    public function grupo()
    {
        $data['title'] = "Grupo · " . SITETITLE;
        $this->renderSite('grupo', $data);
    }

    public function parceiros()
    {
        $data['title'] = "Parceiros · " . SITETITLE;
        $this->renderSite('parceiros', $data);
    }

    public function cases()
    {
        $data['title'] = "Cases · " . SITETITLE;
        $this->renderSite('cases', $data);
    }

    public function premios()
    {
        $data['title'] = "Prêmios · " . SITETITLE;
        $this->renderSite('premios', $data);
    }

    public function premioyoutube2023()
    {
        $data['title'] = "Prêmio Youtube Educação Digital 2023 · " . SITETITLE;
        $this->renderSite('premioyoutube2023', $data);
    }

    public function videos()
    {
        $data['title'] = "Vídeos · " . SITETITLE;
        $this->renderSite('videos', $data);
    }

    public function politicaPrivacidade()
    {
        $data['title'] = "Política de privacidade · " . SITETITLE;
        $this->renderSite('politica-privacidade', $data);
    }

    public function projeto()
    {
        $data['title'] = "Projeto SEDUC Amazonas · " . SITETITLE;
        $this->renderSite('projeto-seduc-amazonas', $data);
    }

    public function iptv()
    {
        $data['title'] = "Plataforma IP.TV · " . SITETITLE;
        $this->renderSite('iptv', $data);
    }

    public function whitelabel()
    {
        $data['title'] = "Whitelabel · " . SITETITLE;
        $this->renderSite('whitelabel', $data);
    }

    public function ava()
    {
        $data['title'] = "Plataforma Ava · " . SITETITLE;
        $this->renderSite('ava', $data);
    }

    public function studioPack()
    {
        $data['title'] = "Studio Pack · " . SITETITLE;
        $this->renderSite('studio-pack', $data);
    }

    public function produtora()
    {
        $data['title'] = "Produtora · " . SITETITLE;
        $this->renderSite('produtora', $data);
    }

    public function compliance()
    {
        $data['title'] = "Compliance · " . SITETITLE;
        $this->renderSite('compliance', $data);
    }

}
