<div>
    <div wire:ignore.self class="modal fade" id="EditCountryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form wire:submit.prevent="update">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" wire:model="cid">
                            <select class="form-control @error('edit_continent_id') is-invalid @enderror" wire:model="edit_continent_id">
                                <option value="">Not Selected</option>
                                @foreach ($continents as $con )
                                <option value="{{ $con->id }}">{{ $con->continent_name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger"> @error('edit_continent_id') {{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control @error('edit_country_name') is-invalid @enderror" wire:model="edit_country_name" placeholder="Enter Country Name..">
                            <span class="text-danger"> @error('edit_country_name') {{ $message }}@enderror</span>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control @error('edit_capital_city') is-invalid @enderror" wire:model="edit_capital_city" placeholder="Enter Capital City Name..">
                            <span class="text-danger"> @error('edit_capital_city') {{ $message }}@enderror</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
