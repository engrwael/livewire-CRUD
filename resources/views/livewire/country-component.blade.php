<div>
    <div class="py-2">
        <button class="btn btn-sm btn-primary" wire:click="openAddCountryModal()">Add Country</button>
        <div class="pt-1">
            <button class="btn btn-sm btn-warning" wire:click="multipleDelete()">Delete Selected Countries ({{ count($checkedCountries) }})</button>
        </div>
    </div>

    <hr style="background-color:salmon">

    <div class="py-1">
        <div class="row">
            <div class="col-2">
                <label>Continent</label>
                <select wire:model='byContinent' class="custom-select">
                    <option>Choose</option>
                    @foreach ($continents as $con )
                    <option value={{ $con->id }}>{{ $con->continent_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-3">
                <label>Search</label>
                <input type="text" wire:model='search' class="form-control">
            </div>

            <div class="col-2">
                <label>PerPage</label>
                <select wire:model='perPage' class="custom-select">
                    <option>Choose</option>
                    <option value=5>5</option>
                    <option value=10>10</option>
                    <option value=15>15</option>
                    <option value=20>20</option>
                </select>
            </div>

            <div class="col-3">
                <label>OrderBy</label>
                <select wire:model='byOrder' class="custom-select">
                    <option>Choose</option>
                    <option value="country_name">Country Name</option>
                    <option value="capital_city">Capital City</option>
                </select>
            </div>

            <div class="col-2">
                <label>SortBy</label>
                <select wire:model='bySort' class="custom-select">
                    <option>Choose</option>
                    <option value="asc">ASC</option>
                    <option value="desc">DESC</option>
                </select>
            </div>
        </div>
    </div>

    <div class="d-flex py-2">
        <table class="table table-light table-hover table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Select</th>
                    <th>ID</th>
                    <th>Country</th>
                    <th>Capital</th>
                    <th>Continent</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($countries as $country )
                <tr class="{{ $this->isChecked($country->id) }}">
                    <td>
                        <input type="checkbox" wire:model="checkedCountries" value="{{ $country->id }}">
                    </td>
                    <td>{{ $country->id }}</td>
                    <td>{{ $country->country_name }}</td>
                    <td>{{ $country->capital_city }}</td>
                    <td>{{ $country->continent->continent_name }}</td>
                    <td>
                        <div class="d-flex">
                            <button class="btn btn-sm btn-info m-1" wire:click="openEditCountryModal({{ $country->id }})">Edit</button>
                            <button class="btn btn-sm btn-danger m-1" wire:click="confirmDelete({{ $country->id }})">Delete</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $countries->links("pagination::bootstrap-4") }}
            </div>
        </div>
    </div>


    @include('livewire.add-modal')
    @include('livewire.edit-modal')
</div>
