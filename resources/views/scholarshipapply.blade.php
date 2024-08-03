 <!-- pop up box -->
 @if(Auth::check())  
 <div id="pageOverlay" class="page-overlay" style="display:none;"></div>
              <div id="popupForm" class="popup-container" style="display:none;">
                <div class="popup-content">
                    <span class="close-btn" onclick="closeForm()">&times;</span>
                    <h2>Application Form</h2>
                    <!-- Form content here -->
                    <form action="{{ route('applicant.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                        <div class="form-group">
                          <label for="name">Full Name<span class="optional">*</span></label>
                          <input type="text" maxlength="100" id="name" name="name" value="{{ $user->name }}" required>
                        </div>

                        <div class="form-group">
                          <label for="gender">Gender<span class="optional">*</span></label>
                          <select id="gender" name="gender" required>
                              <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                              <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                              <option value="Other" {{ $user->gender == 'Other' ? 'selected' : '' }}>Other</option>
                          </select>
                        </div>

                        <div class="form-group">
                            <label for="birthday">Birthday<span class="optional">*</span></label>
                            <input type="date" id="birthday" name="birthday" required>
                          </div>

                          <div class="form-group">
                            <label for="nric">NRIC No.<span class="optional">*</span></label>
                            <input type="text" id="nric" minlength="12" maxlength="12" name="nric" required>
                          </div>

                          <div class="form-group">
                            <label for="email">Email Address<span class="optional">*</span></label>
                            <input type="email" id="email" maxlength="100" name="email" value="{{ $user->email }}" required>
                          </div>

                          <div class="form-group">
                            <label for="home">Home Address<span class="optional">*</span></label>
                            <input type="text" id="home" name="address" value="{{ $user->address }}" required>
                          </div>

                          <div class="form-group">
                            <label for="contact">Contact Number<span class="optional">*</span></label>
                            <input type="text" id="contact"  maxlength="11" name="contact" value="{{ $user->phone }}" required>
                          </div>

                          <div class="form-group">
                              <label for="course">Course(s) interested<span class="optional">*</span></label>
                              <select id="course" name="course" required>
                                  <option value="" selected>Select Course</option>
                                  <option value="Computer Science">Computer Science</option>
                                  <option value="Engineering">Engineering</option>
                                  <option value="Biology">Biology</option>
                                  <option value="Psychology">Psychology</option>
                                  <option value="Business Administration">Business Administration</option>
                                  <option value="Mathematics">Mathematics</option>
                                  <option value="English Literature">English Literature</option>
                                  <option value="History">History</option>
                                  <option value="Chemistry">Chemistry</option>
                                  <option value="Economics">Economics</option>
                                  <option value="Political Scienc">Political Science</option>
                                  <option value="Physics">Physics</option>
                                  <option value="Sociology">Sociology</option>
                                  <option value="Art History">Art History</option>
                                  <option value="Environmental Science">Environmental Science</option>
                                  <option value="Philosophy">Philosophy</option>
                                  <option value="Anthropology">Anthropology</option>
                                  <option value="Foreign Languages">Foreign Languages</option>
                                  <option value="Health Sciences">Health Sciences</option>
                                  <option value="Music">Music</option>
                                  <option value="Theater">Theater</option>
                                  <option value="Graphic Design">Graphic Design</option>
                                  <option value="Other">Other</option>
                              </select>
                          </div>

                          <div class="form-group">
                              <label for="qualification">Current Qualification<span class="optional">*</span></label>
                              <select id="qualification" name="qualification" required>
                                  <option value="" selected>Select Qualification</option>
                                  <option value="Foundation">Foundation</option>
                                  <option value="High School">High School</option>
                                  <option value="Associate Degree">Associate Degree</option>
                                  <option value="Bachelor's Degree">Bachelor's</option>
                                  <option value="Other">Other</option>
                              </select>
                          </div>

                          <div class="form-group">
                            @if ($user && $user->file)
                                <div class="form-group">
                                    <label>Current Transcript:</label>
                                    <a href="{{ Storage::url($user->file) }}" target="_blank" name="file" class="underline">View Current Transcript</a>
                                </div>
                            @endif

                            @if ($user && $user->file)
                            <div class="form-group">
                                <label for="file">Educational Documents (if you want to upload a new one)</label>
                                <input type="file" id="file" name="file">
                            </div>
                            @else
                            <div class="form-group">
                                <label for="file">Educational Documents<span class="optional">*</span></label>
                                <input type="file" id="file" name="file" required>
                            </div>
                            @endif
                            
                          </div>
                        
                        <input type="hidden" id="universityId" name="universityId" value="{{ $item->userId }}">
                        <input type="hidden" id="scholarshipId" name="scholarshipId" value="{{ $item->id }}">
                        <button type="submit" class="btn-save">Submit</button>
                    </form>
                </div>
            </div>
@endif