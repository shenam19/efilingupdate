<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OrganizationHierarchy;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Jetstream\DeleteUser;
use App\Models\Position;

//finds all "id:\d+" in a string and returns all the \d+ in an array
function extractIds($str)
{
    $pattern = "/\"id\":(\d+)/i";
    $ids = array();
    if(preg_match_all($pattern, $str, $matches)) {
        $ids = array_map('intval',$matches[1]);
    }    
    return $ids;
}
class ManageStaffController extends Controller
{
    public function index()
    {
        abort_if(!auth()->user()->can('manage account with staff role'),403);        
        
        //if user is Super-Admin show all roles and tree-dropdown has all org tree.
        if(auth()->user()->hasRole('Super-Admin')){            
            $staffs = User::with('organization','roles')
                ->where('id','!=',auth()->user()->id)
                ->paginate(10);       
            $positions = Position::get();
            $orgs = OrganizationHierarchy::getAllOrgCharts();
            $orgs = str_replace('name_short','label',$orgs);            
            return view('manage-staff.index', ['staffs'=>$staffs,'orgs'=>$orgs,'positions'=>$positions]);

        }
        
            //if user is admin show all admins and staff in it's org sub tree and tree-dropdown has it's org tree.
            //Logged in user's Organization
            $orgs = auth()->user()->organization->getOrgChart();
            $orgs = str_replace('name_short','label',$orgs);
            $myOrgIds = extractIds($orgs);
            //get all user of any role that works in my org sub tree
            $staffs = User::with('organization','roles','position')->whereIn('works_at',$myOrgIds)                
                ->role('staff')
                ->where('id','!=',auth()->user()->id)
                ->paginate(10);

            $positions = Position::get();

            return view('manage-staff.index', ['staffs'=>$staffs,'orgs'=>$orgs,'positions'=>$positions]);        
    }
    public function store(Request $request){

        abort_if(!auth()->user()->can('manage account with staff role'),403);
        $userCreator = new CreateNewUser();

        $errorMessage = $userCreator->validate($request->all());
        if($errorMessage != "")
        {
            return redirect()->back()->with('error', $errorMessage);    
        }
        $user = $userCreator->create($request->all());        
        $staffRole = Role::where('name','staff')->get();
        $user->assignRole($staffRole);
        return redirect()->back()->with('success', 'Staff account created.');    
    }
    
    public function destroy(Request $request){

        abort_if(!auth()->user()->can('manage account with staff role'),403);                
        $staffArray = $request->all()['staffList'];
        
        foreach($staffArray as $i){
            $userObject = User::find($i);        
            (new DeleteUser())->delete($userObject);            
        }
        
        return redirect()->back()->with('success', 'Staff account deleted.');    
    }

    public function edit(Request $request){
        abort_if(!auth()->user()->can('manage account with staff role'),403);                        
        $userCreator = new CreateNewUser();
        $errorMessage = $userCreator->updateValidate($request->all());
        if($errorMessage != "")
        {
            return redirect()->back()->with('error', $errorMessage);    
        }
        $user = $userCreator->update($request->all());        
        return redirect()->back()->with('success', 'Staff account updated.');    
    }
}
