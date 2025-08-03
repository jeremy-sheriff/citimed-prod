# Improvement Tasks

This document contains a list of tasks for improving the CitiMed application. Mark tasks as completed by changing `[ ]` to `[x]`.

## Code Quality Improvements

- [x] Fix typo in Balance::find($this->previous_balance_id)->update(['status' => 'carried_foward']) - should be 'carried_forward'
- [x] Add missing type_of_diagnosis to resetForm() method in Visits/Add.php (verified: already included in line 426)
- [x] Improve error handling in the saveVisit method to provide more specific error messages (added specific handling for database and validation errors)
- [x] Add proper PHPDoc comments to all methods in Visits/Add.php (added/improved PHPDoc comments for rules(), messages(), and resetForm() methods)
- [x] Refactor the saveVisit method to reduce complexity and improve readability (extracted functionality into smaller, focused methods)
- [x] Implement proper validation for all form fields in Visits/Add.php (enhanced validation rules and added comprehensive error messages)

## Feature Improvements

- [ ] Add confirmation dialog before submitting a visit to prevent accidental submissions
- [ ] Implement a feature to save visit drafts before final submission
- [ ] Add the ability to upload and attach files to visits (like lab results or images)
- [ ] Implement a follow-up scheduling feature for visits

## Performance Improvements

- [ ] Optimize database queries in the Visits/Add component
- [ ] Implement caching for frequently accessed patient data
- [ ] Reduce unnecessary re-renders in Livewire components

## Security Improvements

- [ ] Ensure all user inputs are properly validated and sanitized
- [ ] Implement proper authorization checks for all visit-related actions
- [ ] Add CSRF protection to all forms

## Documentation Improvements

- [ ] Create comprehensive documentation for the visit creation process
- [ ] Document the payment and balance calculation logic
- [ ] Add inline comments explaining complex business logic
