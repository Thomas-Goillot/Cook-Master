<?php 

namespace Controllers;

use App\Controller;

class Resetting extends Controller{


    /**
     * Default path to the view
     * @var string
     */
    private string $default_path = "resetting/password";

    /**
     * Display the user forgot password page
     *
     * @return void
     */
    public function password(): void
    {

        $page_name = "Forgot Password";

        $this->render($this->default_path, compact('page_name'), OTHERS);
    }


}
