{{-- <section class="ftco-section ftco-no-pb ftco-no-pt">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="search-wrap-1 ftco-animate mb-5">
                  <form action="{{ route('SearchVehicle') }}" method="GET" class="search-property-1">
                      <div class="row">
                          <div class="col-lg">
                              <div class="form-group">
                                  <label for="Model">Select Model</label>
                                  <input type="text" name="Model" class="form-control" placeholder="Enter Model">
                              </div>
                          </div>
                          <div class="col-lg">
                              <div class="form-group">
                                  <label for="Price">Price Limit</label>
                                  <input type="number" name="Price" class="form-control" placeholder="Enter Price Limit">
                              </div>
                          </div>
                          <div class="col-lg">
                              <div class="form-group">
                                  <label for="Fuel_Type">Select Fuel Type</label>
                                  <input type="text" name="Fuel_Type" class="form-control" placeholder="Enter Fuel Type">
                              </div>
                          </div>
                          <div class="col-lg align-self-end">
                              <div class="form-group">
                               <div class="form-field">
                                    <input type="submit" value="Search" class="form-control btn btn-primary">
                                </div>
                              </div>
                          </div>
                      </div>
                  </form>
                
              </div>
          </div>
      </div>
  </div>
</section> --}}
<section class="ftco-section ftco-no-pb ftco-no-pt">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="search-wrap-1 ftco-animate mb-5">
                  <form action="{{ route('SearchVehicle') }}" method="GET" class="search-property-1">
                      <div class="row">
                          <div class="col-lg">
                              <div class="form-group">
                                  <label for="Model">Select Model</label>
                                  <input type="text" name="Model" class="form-control" placeholder="Enter Model">
                              </div>
                          </div>
                          <div class="col-lg">
                              <div class="form-group">
                                  <label for="Price">Price Limit(/hour)</label>
                                  <input type="number" name="Price" class="form-control" placeholder="Enter Price Limit">
                              </div>
                          </div>
                          <div class="col-lg">
                              <div class="form-group">
                                  <label for="Fuel_Type">Select Fuel Type</label>
                                  <input type="text" name="Fuel_Type" class="form-control" placeholder="Enter Fuel Type">
                              </div>
                          </div>
                          <div class="col-lg align-self-end">
                              <div class="form-group">
                                  <div class="form-field d-flex">
                                      <input type="submit" value="Search" class="form-control btn btn-primary mr-3">
                                      <input type="submit" href="{{ route('ClearFilters') }}" class="form-control btn btn-primary" value='Clear'>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</section>
