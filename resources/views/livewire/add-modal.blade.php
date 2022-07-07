<div>
    <div wire:ignore.self class="modal fade" id="AddCountryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="form-group">
                            <select class="form-control @error('continent_id') is-invalid @enderror" wire:model="continent_id">
                                <option value="">Not Selected</option>
                                @foreach ($continents as $con )
                                <option value="{{ $con->id }}">{{ $con->continent_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger"> @error('continent_id') {{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control @error('country_name') is-invalid @enderror" wire:model="country_name" placeholder="Enter Country Name..">
                            <span class="text-danger"> @error('country_name') {{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control @error('capital_city') is-invalid @enderror" wire:model="capital_city" placeholder="Enter Capital City Name..">
                            <span class="text-danger"> @error('capital_city') {{ $message }}@enderror</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
