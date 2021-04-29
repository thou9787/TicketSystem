<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Search database by filter attribute
     *
     * @param Illuminate\Http\Request $requestFilters
     * @param object $queryBuilder
     *
     * @return array
     */
    private function search($requestFilters, $queryBuilder)
    {
        if (isset($requestFilters)) {
            $filters = explode(',', $requestFilters);
            // foreach ($filters as $key => $filter) {
            //     if (strpos($filter, ':')) {
            //         list($key, $value) = explode(':', $filter);
            //         $queryBuilder->where($key, 'like', "%$value%");
            //     }
            // }
            foreach ($filters as $filter) {
                $queryBuilder->where('id', 'like', "%$filter%")
                            ->orWhere('trainNo', 'like', "%$filter%")
                            ->orWhere('originStationName', 'like', "%$filter%")
                            ->orWhere('destinationStationName', 'like', "%$filter%")
                            ->orWhere('departureTime', 'like', "%$filter%")
                            ->orWhere('arrivalTime', 'like', "%$filter%")
                            ->orWhere('fare', 'like', "%$filter%")
                            ->orWhere('amount', 'like', "%$filter%")
                            ->orWhere('user_id', 'like', "%$filter%")
                            ->orWhere('trainDate', 'like', "%$filter%")
                            ->orWhere('paid', 'like', "%$filter%")
                            ->orWhere('user_id', 'like', "%$filter%");
            }
        }
        return $queryBuilder->orderBy('id', 'desc')->get();
    }

    /**
     * Show the request ticket table
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Contracts\Support\Renderable
     */
    public function showTickets(Request $request)
    {
        $ticketQuery = Ticket::query();

        $tickets = $this->search($request->filters, $ticketQuery);

        return view(
            'admin_tickets',
            [
                'tickets' => $tickets,
                'trainNoList' => [
                    "0108", "0109", "0112", "0113", "0116",
                    "0117", "0120", "0121", "0124", "0125",
                    "0128", "0129", "0132", "0133", "0136",
                    "0137", "0140", "0141", "0144", "0145",
                    "0148", "0149", "0152", "0153", "0156",
                    "0157", "0160", "0161", "0165", "0203",
                    "0204", "0205", "0206", "0242", "0249",
                    "0294", "0295", "0300", "0333", "0502",
                    "0508", "0565", "0567", "0583", "0598",
                    "0603", "0606", "0609", "0610", "0612",
                    "0613", "0615", "0616", "0618", "0619",
                    "0621", "0624", "0625", "0627", "0628",
                    "0630", "0633", "0636", "0639", "0642",
                    "0645", "0648", "0651", "0654", "0657",
                    "0658", "0660", "0661", "0663", "0664",
                    "0666", "0667", "0669", "0670", "0672",
                    "0673", "0675", "0676", "0678", "0681",
                    "0684", "0687", "0690", "0693", "0696",
                    "0802", "0803", "0805", "0806", "0809",
                    "0810", "0813", "0814", "0817", "0818",
                    "0821", "0822", "0825", "0826", "0829",
                    "0830", "0833", "0834", "0837", "0838",
                    "0841", "0842", "0845", "0846", "0849",
                    "0850", "0853", "0854", "0857", "0858",
                    "0861", "0862", "1210", "1234", "1237",
                    "1238", "1241", "1245", "1246", "1250",
                    "1253", "1254", "1257", "1258", "1264",
                    "1318", "1320", "1326", "1328", "1330",
                    "1538", "1541", "1542", "1545", "1546",
                    "1549", "1550", "1553", "1554", "1557",
                    "1558", "1562", "1563", "1566", "1570",
                    "1622", "1640", "1643", "1646", "1649",
                    "1652", "1655", "1679", "1682", "1685",
                    "1688"
                ],
                'placeList' => [
                    "南港", "台北", "板橋", "桃園", "新竹", "苗栗",
                    "台中", "彰化", "雲林", "嘉義", "台南", "左營",
                ],
            ]
        );
    }

    /**
     * Show the request user table
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Contracts\Support\Renderable
     */
    public function showUsers(Request $request)
    {
        $userQuery = User::query();

        $users = $this->search($request->filters, $userQuery);

        return view(
            'admin_users',
            [
                'users' => $users,
            ]
        );
    }
}
