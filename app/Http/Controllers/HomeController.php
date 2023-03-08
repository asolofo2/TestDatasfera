<?php

namespace App\Http\Controllers;

use App\Helpers\API;
use App\Models\Lead;
use App\Models\User;
use App\Models\Contact;
use App\Models\Companie;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        /* LINK FOR ENTITIES */
        $link_lead = API::apiLink('leads', 'v2');

        $link_contact = API::apiLink('contacts', 'v2');
        $link_company = API::apiLink('companies', 'v2');
        $link_user = API::apiLink('users', 'v4');

        /* Ссылка API сущностей */
        $leads = API::getAPI($link_lead);
        $contacts = API::getAPI($link_contact);
        $companies = API::getAPI($link_company);
        $users = API::getAPI($link_user, true);

        /* Сделки */
        if (!is_null($leads)) {
            foreach ($leads as $lead) {
                foreach ($lead['contacts']['id'] as $contact) {
                    $contact_id = (int) $contact;
                }

                $companie_id = (int) $lead['company']['id'];

                Lead::updateOrCreate([
                    'id' =>  $lead['id'],
                    'name' => $lead['name'],
                    'user_id' => $lead['responsible_user_id'],
                    'sale' => $lead['sale'],
                    'contact_id' => $contact_id,
                    'companie_id' => $companie_id
                ]);
            }
        }

        /* Контакты */
        if (!is_null($contacts)) {
            foreach ($contacts as $contact) {
                Contact::updateOrCreate([
                    'id' =>  $contact['id'],
                    'name' => $contact['name']
                ]);
            }
        }

        /* Компания */
        if (!is_null($companies)) {
            foreach ($companies as $companie) {
                Companie::updateOrCreate([
                    'id' =>  $companie['id'],
                    'name' => $companie['name']
                ]);
            }
        }

        /* пользователь */
        if (!is_null($users['users'])) {

            foreach ($users['users'] as $user) {

                User::updateOrCreate([
                    'id' =>  $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => ''
                ]);
            }
        }

        $datas = Lead::with('contact', 'companie')->latest('id')->get();

        return view('welcome', ['datas' => $datas]);
    }
}
