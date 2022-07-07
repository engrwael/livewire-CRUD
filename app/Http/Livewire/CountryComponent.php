<?php

namespace App\Http\Livewire;

use App\Models\Continent;
use App\Models\Country;
use Livewire\Component;
use Livewire\WithPagination;

class CountryComponent extends Component
{
    use WithPagination;

    /**
     * Defining Properties for CRUD
     */
    public $continent_id, $country_name, $capital_city;
    public $edit_continent_id, $edit_country_name, $edit_capital_city, $cid;
    public $checkedCountries = [];

    /**
     * Search Properties
     */

    public $byContinent = null;
    public $search;
    public $byOrder = 'country_name';
    public $bySort = 'asc';
    public $perPage = 5;

    /**
     * Listeners to be Fired after CRUD Process
     *
     * @var array
     */
    protected $listeners = [
        'postAdded' => 'save',
        'postEdited' => 'edit',
        'deleted' => 'delete',
        'multi-deleted' => 'deleteCheckedCountries',
    ];


    /**
     * Validation Rules to test Realtime Validations
     *
     * @var array
     */
    protected $rules = [
        'continent_id' => 'required',
        'country_name' => 'required|unique:countries',
        'capital_city' => 'required',
        'edit_continent_id' => 'required',
        'edit_country_name' => 'required|unique:countries,country_name',
        'edit_capital_city' => 'required'
    ];

    /**
     * Livewire Hook for realtime validations
     * @return array
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.country-component', [
            'continents' => Continent::all(),
            'countries' => Country::when($this->byContinent, function ($query) {
                $query->where('continent_id', $this->byContinent);
            })
                ->search(trim($this->search))
                ->orderBy($this->byOrder, $this->bySort)
                ->paginate($this->perPage)
        ]);
    }


    /**
     * Open Create Modal and reset all inputs
     *
     * @return void
     */
    public function openAddCountryModal()
    {
        $this->reset();
        return $this->dispatchBrowserEvent('openAddCountryModal', [
            'title' => 'Hello from Adding Modal'
        ]);
    }


    /**
     * Open Update Modal
     *
     * @return void
     */
    public function openEditCountryModal($id)
    {

        $info = Country::find($id);

        $this->cid = $info->id;
        $this->edit_continent_id = $info->continent->id;
        $this->edit_country_name = $info->country_name;
        $this->edit_capital_city = $info->capital_city;

        return $this->dispatchBrowserEvent('openEditCountryModal');
    }

    /**
     * Create Country
     *
     * @return object
     */
    public function save()
    {

        $create = Country::create([
            'continent_id' => $this->continent_id,
            'country_name' => $this->country_name,
            'capital_city' => $this->capital_city,
        ]);

        if ($create) {
            $this->checkedCountries = [];
            return $this->dispatchBrowserEvent('success', [
                'success' => 'Created Successfully'
            ]);
        }

        $this->emit('postAdded');
    }


    /**
     * Update Country
     *
     * @return object
     */
    public function update()
    {
        $country = Country::findOrFail($this->cid);

        $update = $country->update([
            'continent_id' => $this->edit_continent_id,
            'country_name' => $this->edit_country_name,
            'capital_city' => $this->edit_capital_city
        ]);

        if ($update) {
            $this->checkedCountries = [];
            return $this->dispatchBrowserEvent('success-update', [
                'success' => 'Updated Successfully'
            ]);
        }

        $this->emit('postEdited');
    }

    /**
     * Confirm delete Message
     */
    public function confirmDelete($id)
    {
        $info = Country::findOrFail($id);
        if ($info) {
            return $this->dispatchBrowserEvent('confirm-delete', [
                'confirm' => 'Do you want to Delete <strong>' . $info->country_name . '</strong>',
                'country' => '<strong>' . $info->country_name . '</strong>',
                'id' => $id
            ]);
        }
    }

    public function delete($id)
    {
        $info = Country::findOrFail($id);

        if ($info) {
            $info->delete();
            $this->checkedCountries = [];
            return $this->dispatchBrowserEvent('delete-success', [
                'success' => '<strong>' . $info->country_name . '</strong> deleted Successfully',
            ]);
        }
    }

    public function multipleDelete()
    {
        $ids = $this->checkedCountries;
        if ($ids) {
            return $this->dispatchBrowserEvent('multiple-delete', [
                'confirm' => 'Are you Sure deleting  the Selected Countries!',
                'ids' => $ids
            ]);
        } else {
            return $this->dispatchBrowserEvent('multiple-delete-error', [
                'confirm' => 'Nothing has been Selected !'
            ]);
        }
    }

    public function deleteCheckedCountries($ids)
    {
        Country::whereKey($ids)->delete();
        $this->checkedCountries = [];
        return $this->dispatchBrowserEvent('multi-delete-success', [
            'success' => 'Selected Countries have deleted Successfully',
        ]);
    }


    public function isChecked($id)
    {
        return in_array($id, $this->checkedCountries) ? 'bg-warning text-dark' : '';
    }
}