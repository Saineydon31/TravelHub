# TravelHub Complete Folder Structure

## Project Root Structure

```
TravelHub/
├── frontend/                        # React.js Frontend Application
├── backend/                         # Laravel Backend Application
├── documentation/                   # Project Documentation
├── docker/                          # Docker Configuration
├── scripts/                         # Utility Scripts
├── .github/                         # GitHub Configuration
├── .gitignore                       # Git Ignore Rules
├── README.md                        # Project Overview
├── SYSTEM_ARCHITECTURE.md          # Architecture Documentation
├── FOLDER_STRUCTURE.md             # This file
├── DATABASE_SCHEMA.md              # Database Design
├── API_DOCUMENTATION.md            # API Reference
├── DEPLOYMENT_GUIDE.md             # Deployment Instructions
└── DEVELOPMENT_SETUP.md            # Development Setup Guide
```

---

## Frontend Structure (`/frontend`)

```
frontend/
├── public/
│   ├── index.html                  # Main HTML Entry Point
│   ├── favicon.ico                 # Site Icon
│   ├── manifest.json               # PWA Manifest
│   └── robots.txt                  # SEO Robots File
│
├── src/
│   ├── index.js                    # React Entry Point
│   ├── App.js                      # Root App Component
│   ├── App.css                     # Root Styles
│   │
│   ├── api/                        # API Client Layer
│   │   ├── axios.js                # Axios Instance Configuration
│   │   ├── endpoints.js            # API Endpoint Constants
│   │   ├── auth.api.js             # Authentication APIs
│   │   ├── user.api.js             # User Management APIs
│   │   ├── vendor.api.js           # Vendor Management APIs
│   │   ├── booking.api.js          # Booking APIs
│   │   ├── payment.api.js          # Payment APIs
│   │   ├── affiliate.api.js        # Affiliate APIs
│   │   ├── review.api.js           # Review APIs
│   │   ├── message.api.js          # Messaging APIs
│   │   ├── listing.api.js          # Listing APIs
│   │   ├── search.api.js           # Search APIs
│   │   ├── analytics.api.js        # Analytics APIs
│   │   └── admin.api.js            # Admin APIs
│   │
│   ├── store/                      # Redux Store Configuration
│   │   ├── index.js                # Store Setup
│   │   ├── slices/
│   │   │   ├── authSlice.js        # Authentication State
│   │   │   ├── userSlice.js        # User State
│   │   │   ├── vendorSlice.js      # Vendor State
│   │   │   ├── bookingSlice.js     # Booking State
│   │   │   ├── paymentSlice.js     # Payment State
│   │   │   ├── affiliateSlice.js   # Affiliate State
│   │   │   ├── reviewSlice.js      # Review State
│   │   │   ├── messageSlice.js     # Message State
│   │   │   ├── uiSlice.js          # UI State
│   │   │   ├── notificationSlice.js # Notification State
│   │   │   └── filterSlice.js      # Filter State
│   │   │
│   │   └── actions/
│   │       ├── authActions.js      # Auth Actions
│   │       ├── vendorActions.js    # Vendor Actions
│   │       ├── bookingActions.js   # Booking Actions
│   │       └── paymentActions.js   # Payment Actions
│   │
│   ├── context/                    # Context API
│   │   ├── AuthContext.js          # Auth Context
│   │   ├── ThemeContext.js         # Theme Context
│   │   ├── NotificationContext.js  # Notification Context
│   │   ├── LanguageContext.js      # Language/i18n Context
│   │   └── SocketContext.js        # WebSocket Context
│   │
│   ├── hooks/                      # Custom React Hooks
│   │   ├── useAuth.js              # Auth Hook
│   │   ├── useUser.js              # User Hook
│   │   ├── useFetch.js             # Data Fetching Hook
│   │   ├── useForm.js              # Form Handling Hook
│   │   ├── useLocalStorage.js      # LocalStorage Hook
│   │   ├── useNotification.js      # Notification Hook
│   │   ├── useSocket.js            # WebSocket Hook
│   │   ├── useDebounce.js          # Debounce Hook
│   │   ├── useThrottle.js          # Throttle Hook
│   │   ├── usePagination.js        # Pagination Hook
│   │   └── useResponsive.js        # Responsive Design Hook
│   │
│   ├── components/                 # Reusable Components
│   │   ├── Common/
│   │   │   ├── Header.js
│   │   │   ├── Footer.js
│   │   │   ├── Navbar.js
│   │   │   ├── Sidebar.js
│   │   │   ├── Breadcrumb.js
│   │   │   ├── Pagination.js
│   │   │   ├── Loading.js
│   │   │   ├── Error.js
│   │   │   ├── Modal.js
│   │   │   ├── Button.js
│   │   │   ├── Input.js
│   │   │   ├── Select.js
│   │   │   ├── Card.js
│   │   │   ├── Badge.js
│   │   │   ├── Alert.js
│   │   │   ├── Toast.js
│   │   │   ├── DropdownMenu.js
│   │   │   ├── Tooltip.js
│   │   │   └── Spinner.js
│   │   │
│   │   ├── Auth/
│   │   │   ├── LoginForm.js
│   │   │   ├── RegisterForm.js
│   │   │   ├── ForgotPasswordForm.js
│   │   │   ├── ResetPasswordForm.js
│   │   │   ├── TwoFactorAuth.js
│   │   │   └── ProtectedRoute.js
│   │   │
│   │   ├── User/
│   │   │   ├── UserProfile.js
│   │   │   ├── UserProfileEdit.js
│   │   │   ├── UserAvatar.js
│   │   │   ├── UserSettings.js
│   │   │   ├── UserPreferences.js
│   │   │   └── UserNotifications.js
│   │   │
│   │   ├── Traveler/
│   │   │   ├── SearchBar.js
│   │   │   ├── FilterPanel.js
│   │   │   ├── ListingCard.js
│   │   │   ├── ListingDetail.js
│   │   │   ├── BookingForm.js
│   │   │   ├── BookingRequest.js
│   │   │   ├── FavoriteButton.js
│   │   │   ├── ReviewForm.js
│   │   │   └── TripPlanner.js
│   │   │
│   │   ├── Vendor/
│   │   │   ├── VendorOnboarding.js
│   │   │   ├── VendorTypeSelector.js
│   │   │   ├── ListingForm.js
│   │   │   ├── ListingEditor.js
│   │   │   ├── CalendarManager.js
│   │   │   ├── PricingManager.js
│   │   │   ├── AvailabilityManager.js
│   │   │   ├── PhotoUploader.js
│   │   │   └── AmenitySelector.js
│   │   │
│   │   ├── Booking/
│   │   │   ├── BookingList.js
│   │   │   ├── BookingDetail.js
│   │   │   ├── BookingStatusBadge.js
│   │   │   ├── BookingTimeline.js
│   │   │   ├── BookingChat.js
│   │   │   └── BookingCancellation.js
│   │   │
│   │   ├── Payment/
│   │   │   ├── PaymentForm.js
│   │   │   ├── PaymentMethodSelector.js
│   │   │   ├── PaymentProcessing.js
│   │   │   ├── PaymentConfirmation.js
│   │   │   ├── RefundForm.js
│   │   │   ├── PaymentHistory.js
│   │   │   └── InvoiceViewer.js
│   │   │
│   │   ├── Affiliate/
│   │   │   ├── AffiliateSignup.js
│   │   │   ├── ReferralLinkGenerator.js
│   │   │   ├── CommissionTracker.js
│   │   │   ├── PerformanceChart.js
│   │   │   ├── PayoutRequester.js
│   │   │   └── MarketingMaterials.js
│   │   │
│   │   ├── Message/
│   │   │   ├── ChatWindow.js
│   │   │   ├── MessageList.js
│   │   │   ├── MessageInput.js
│   │   │   ├── ConversationList.js
│   │   │   ├── VoiceCall.js
│   │   │   ├── VideoCall.js
│   │   │   └── FileUpload.js
│   │   │
│   │   ├── Review/
│   │   │   ├── ReviewForm.js
│   │   │   ├── ReviewCard.js
│   │   │   ├── ReviewList.js
│   │   │   ├── RatingStars.js
│   │   │   ├── ReviewModeration.js
│   │   │   └── VendorResponse.js
│   │   │
│   │   ├── Admin/
│   │   │   ├── Dashboard.js
│   │   │   ├── UserManagement.js
│   │   │   ├── VendorManagement.js
│   │   │   ├── BookingManagement.js
│   │   │   ├── PaymentManagement.js
│   │   │   ├── CommissionManagement.js
│   │   │   ├── FraudCenter.js
│   │   │   ├── AuditLog.js
│   │   │   └── SettingsPanel.js
│   │   │
│   │   └── Analytics/
│   │       ├── AnalyticsDashboard.js
│   │       ├── RevenueChart.js
│   │       ├── UserChart.js
│   │       ├── BookingChart.js
│   │       ├── ConversionChart.js
│   │       └── ReportGenerator.js
│   │
│   ├── pages/                      # Page Components
│   │   ├── Home.js                 # Home Page
│   │   ├── Search.js               # Search Results
│   │   ├── Explore.js              # Explore Destinations
│   │   ├── Listing.js              # Listing Detail
│   │   ├── Booking.js              # Booking Page
│   │   ├── BookingConfirmation.js  # Confirmation
│   │   ├── MyBookings.js           # My Bookings
│   │   ├── MyTrips.js              # My Trips
│   │   ├── Favorites.js            # Saved Favorites
│   │   ├── Reviews.js              # My Reviews
│   │   ├── Messages.js             # Messaging Page
│   │   ├── Profile.js              # User Profile
│   │   │
│   │   ├── Vendor/
│   │   │   ├── VendorDashboard.js
│   │   │   ├── VendorListings.js
│   │   │   ├── VendorBookings.js
│   │   │   ├── VendorCalendar.js
│   │   │   ├── VendorReviews.js
│   │   │   ├── VendorAnalytics.js
│   │   │   ├── VendorEarnings.js
│   │   │   ├── VendorWithdrawals.js
│   │   │   └── VendorSettings.js
│   │   │
│   │   ├── Affiliate/
│   │   │   ├── AffiliateDashboard.js
│   │   │   ├── AffiliateReferrals.js
│   │   │   ├── AffiliateCommissions.js
│   │   │   ├── AffiliateAnalytics.js
│   │   │   ├── AffiliatePayouts.js
│   │   │   └── AffiliateResources.js
│   │   │
│   │   ├── Admin/
│   │   │   ├── AdminDashboard.js
│   │   │   ├── AdminUsers.js
│   │   │   ├── AdminVendors.js
│   │   │   ├── AdminBookings.js
│   │   │   ├── AdminPayments.js
│   │   │   ├── AdminAffiliates.js
│   │   │   ├── AdminReviews.js
│   │   │   ├── AdminMessages.js
│   │   │   ├── AdminSettings.js
│   │   │   ├── FraudCenter.js
│   │   │   ├── SecurityCenter.js
│   │   │   ├── AnalyticsCenter.js
│   │   │   ├── FinanceCenter.js
│   │   │   ├── MarketingCenter.js
│   │   │   ├── ContentCenter.js
│   │   │   └── AuditCenter.js
│   │   │
│   │   ├── CEO/
│   │   │   └── ExecutiveDashboard.js
│   │   │
│   │   ├── Auth/
│   │   │   ├── Login.js
│   │   │   ├── Register.js
│   │   │   ├── ForgotPassword.js
│   │   │   ├── ResetPassword.js
│   │   │   └── VerifyEmail.js
│   │   │
│   │   ├── Legal/
│   │   │   ├── TermsOfService.js
│   │   │   ├── PrivacyPolicy.js
│   │   │   ├── CookiePolicy.js
│   │   │   └── CancelationPolicy.js
│   │   │
│   │   ├── Support/
│   │   │   ├── HelpCenter.js
│   │   │   ├── FAQ.js
│   │   │   ├── ContactUs.js
│   │   │   ├── SupportTickets.js
│   │   │   └── KnowledgeBase.js
│   │   │
│   │   ├── Error/
│   │   │   ├── NotFound.js
│   │   │   ├── Unauthorized.js
│   │   │   ├── ServerError.js
│   │   │   └── Maintenance.js
│   │   │
│   │   └── 404.js
│   │
│   ├── layouts/                    # Layout Components
│   │   ├── MainLayout.js           # Default Layout
│   │   ├── AuthLayout.js           # Auth Page Layout
│   │   ├── AdminLayout.js          # Admin Layout
│   │   ├── VendorLayout.js         # Vendor Layout
│   │   ├── AffiliateLayout.js      # Affiliate Layout
│   │   └── BlankLayout.js          # Blank Layout
│   │
│   ├── styles/                     # Global Styles
│   │   ├── globals.css             # Global Styles
│   │   ├── variables.css           # CSS Variables
│   │   ├── animations.css          # Animations
│   │   ├── responsive.css          # Responsive Breakpoints
│   │   └── bootstrap-custom.css    # Bootstrap Customization
│   │
│   ├── utils/                      # Utility Functions
│   │   ├── formatters.js           # Data Formatters
│   │   ├── validators.js           # Input Validators
│   │   ├── helpers.js              # Helper Functions
│   │   ├── constants.js            # Application Constants
│   │   ├── dates.js                # Date Utilities
│   │   ├── currency.js             # Currency Utilities
│   │   ├── storage.js              # LocalStorage Utilities
│   │   ├── errors.js               # Error Handlers
│   │   ├── config.js               # App Configuration
│   │   ├── socket.js               # WebSocket Utilities
│   │   └── logger.js               # Logging Utilities
│   │
│   └── index.css                   # Root Styles
│
├── package.json                    # Dependencies
├── package-lock.json               # Lock File
├── .env.example                    # Environment Template
├── .env                            # Environment Variables
├── .eslintrc.js                    # ESLint Configuration
├── .prettierrc                     # Prettier Configuration
└── README.md                       # Frontend Documentation
```

---

## Backend Structure (`/backend`)

```
backend/
├── app/
│   ├── Console/                    # Artisan Commands
│   │   ├── Commands/
│   │   │   ├── CreateSuperAdmin.php
│   │   │   ├── GenerateRoles.php
│   │   │   ├── SendNotifications.php
│   │   │   └── ProcessPayments.php
│   │   └── Kernel.php
│   │
│   ├── Http/
│   │   ├── Controllers/            # API Controllers
│   │   │   ├── Controller.php      # Base Controller
│   │   │   ├── Api/
│   │   │   │   ├── AuthController.php
│   │   │   │   ├── UserController.php
│   │   │   │   ├── VendorController.php
│   │   │   │   ├── BookingController.php
│   │   │   │   ├── PaymentController.php
│   │   │   │   ├── ListingController.php
│   │   │   │   ├── ReviewController.php
│   │   │   │   ├── MessageController.php
│   │   │   │   ├── AffiliateController.php
│   │   │   │   ├── SearchController.php
│   │   │   │   ├── AnalyticsController.php
│   │   │   │   └── AdminController.php
│   │   │   │
│   │   │   └── WebhookController.php
│   │   │
│   │   ├── Middleware/             # Request Middleware
│   │   │   ├── Authenticate.php
│   │   │   ├── CheckRole.php
│   │   │   ├── CheckPermission.php
│   │   │   ├── VerifyVendor.php
│   │   │   ├── RateLimiting.php
│   │   │   ├── CORS.php
│   │   │   ├── TrustProxies.php
│   │   │   ├── TrimStrings.php
│   │   │   └── ValidatePostSize.php
│   │   │
│   │   ├── Requests/               # Form Requests/Validation
│   │   │   ├── LoginRequest.php
│   │   │   ├── RegisterRequest.php
│   │   │   ├── UpdateProfileRequest.php
│   │   │   ├── CreateListingRequest.php
│   │   │   ├── UpdateListingRequest.php
│   │   │   ├── CreateBookingRequest.php
│   │   │   ├── PaymentRequest.php
│   │   │   ├── ReviewRequest.php
│   │   │   ├── MessageRequest.php
│   │   │   └── AdminRequest.php
│   │   │
│   │   └── Resources/              # API Resources/Serialization
│   │       ├── UserResource.php
│   │       ├── VendorResource.php
│   │       ├── ListingResource.php
│   │       ├── BookingResource.php
│   │       ├── PaymentResource.php
│   │       ├── ReviewResource.php
│   │       ├── MessageResource.php
│   │       ├── AffiliateResource.php
│   │       └── AnalyticsResource.php
│   │
│   ├── Models/                     # Eloquent Models
│   │   ├── User.php
│   │   ├── Role.php
│   │   ├── Permission.php
│   │   ├── Vendor.php
│   │   ├── VendorProfile.php
│   │   ├── VendorVerification.php
│   │   ├── Tour.php
│   │   ├── Itinerary.php
│   │   ├── Hotel.php
│   │   ├── Room.php
│   │   ├── Restaurant.php
│   │   ├── Menu.php
│   │   ├── Flight.php
│   │   ├── Transportation.php
│   │   ├── Vehicle.php
│   │   ├── Boat.php
│   │   ├── Equipment.php
│   │   ├── Attraction.js
│   │   ├── Booking.php
│   │   ├── BookingItem.php
│   │   ├── Payment.php
│   │   ├── Refund.php
│   │   ├── Commission.php
│   │   ├── VendorPayout.php
│   │   ├── Affiliate.php
│   │   ├── AffiliateReferral.php
│   │   ├── AffiliateCommission.php
│   │   ├── Review.php
│   │   ├── Conversation.php
│   │   ├── Message.php
│   │   ├── Notification.php
│   │   ├── SupportTicket.php
│   │   ├── FraudAlert.php
│   │   ├── RiskAssessment.php
│   │   ├── AuditLog.php
│   │   ├── AnalyticsReport.php
│   │   ├── Campaign.php
│   │   ├── Coupon.php
│   │   └── PlatformSettings.php
│   │
│   ├── Services/                   # Business Logic Layer
│   │   ├── AuthService.php
│   │   ├── UserService.php
│   │   ├── VendorService.php
│   │   ├── VendorVerificationService.php
│   │   ├── ListingService.php
│   │   ├── BookingService.php
│   │   ├── PaymentService.php
│   │   ├── PaymentGatewayService.php
│   │   ├── CommissionService.php
│   │   ├── RefundService.php
│   │   ├── SettlementService.php
│   │   ├── AffiliateService.php
│   │   ├── ReviewService.php
│   │   ├── MessageService.php
│   │   ├── NotificationService.php
│   │   ├── SearchService.php
│   │   ├── AnalyticsService.php
│   │   ├── FraudDetectionService.php
│   │   ├── RiskAssessmentService.php
│   │   ├── EmailService.php
│   │   ├── SMSService.php
│   │   ├── UploadService.php
│   │   └── ExternalApiService.php
│   │
│   ├── Repositories/               # Data Access Layer
│   │   ├── BaseRepository.php
│   │   ├── UserRepository.php
│   │   ├── VendorRepository.php
│   │   ├── ListingRepository.php
│   │   ├── BookingRepository.php
│   │   ├── PaymentRepository.php
│   │   ├── ReviewRepository.php
│   │   ├── MessageRepository.php
│   │   ├── AffiliateRepository.php
│   │   ├── AnalyticsRepository.php
│   │   └── AdminRepository.php
│   │
│   ├── Events/                     # Event Classes
│   │   ├── UserRegistered.php
│   │   ├── UserLoggedIn.php
│   │   ├── VendorCreated.php
│   │   ├── ListingCreated.php
│   │   ├── BookingCreated.php
│   │   ├── BookingConfirmed.php
│   │   ├── BookingCanceled.php
│   │   ├── PaymentProcessed.php
│   │   ├── RefundInitiated.php
│   │   ├── ReviewSubmitted.php
│   │   ├── MessageSent.php
│   │   ├── AffiliateReferralCreated.php
│   │   ├── CommissionEarned.php
│   │   └── FraudDetected.php
│   │
│   ├── Listeners/                  # Event Listeners
│   │   ├── SendWelcomeEmail.php
│   │   ├── CreateUserProfile.php
│   │   ├── SendBookingConfirmation.php
│   │   ├── ProcessPaymentCommission.php
│   │   ├── SendRefundNotification.php
│   │   ├── SendReviewNotification.php
│   │   ├── UpdateAnalytics.php
│   │   ├── LogAuditEvent.php
│   │   └── AlertSecurityTeam.php
│   │
│   ├── Jobs/                       # Background Jobs
│   │   ├── SendEmailJob.php
│   │   ├── SendSMSJob.php
│   │   ├── ProcessPaymentJob.php
│   │   ├── GenerateReportJob.php
│   │   ├── UpdateAnalyticsJob.php
│   │   ├── PurgeOldDataJob.php
│   │   ├── CalculateCommissionsJob.php
│   │   ├── ProcessSettlementsJob.php
│   │   ├── DetectFraudJob.php
│   │   └── CompressFilesJob.php
│   │
│   ├── Notifications/             # Notification Classes
│   │   ├── WelcomeNotification.php
│   │   ├── BookingConfirmationNotification.php
│   │   ├── BookingCancelledNotification.php
│   │   ├── PaymentSuccessNotification.php
│   │   ├── ReviewNotification.php
│   │   ├── MessageNotification.php
│   │   ├── CommissionNotification.php
│   │   ├── PayoutNotification.php
│   │   ├── AlertNotification.php
│   │   └── AdminNotification.php
│   │
│   ├── Policies/                   # Authorization Policies
│   │   ├── UserPolicy.php
│   │   ├── VendorPolicy.php
│   │   ├── ListingPolicy.php
│   │   ├── BookingPolicy.php
│   │   ├── ReviewPolicy.php
│   │   ├── MessagePolicy.php
│   │   ├── AffiliatePolicy.php
│   │   ├── PaymentPolicy.php
│   │   └── AdminPolicy.php
│   │
│   ├── Exceptions/                 # Custom Exceptions
│   │   ├── Handler.php
│   │   ├── ModelNotFoundException.php
│   │   ├── UnauthorizedActionException.php
│   │   ├── ValidationException.php
│   │   ├── PaymentException.php
│   │   ├── BookingException.php
│   │   └── InternalErrorException.php
│   │
│   ├── Enums/                      # Enums
│   │   ├── UserRole.php
│   │   ├── VendorType.php
│   │   ├── BookingStatus.php
│   │   ├── PaymentStatus.php
│   │   ├── PaymentMethod.php
│   │   ├── CommissionType.php
│   │   ├── ReviewRating.php
│   │   └── NotificationType.php
│   │
│   ├── Traits/                     # Reusable Traits
│   │   ├── HasRoles.php
│   │   ├── HasPermissions.php
│   │   ├── Auditable.php
│   │   ├── Filterable.php
│   │   ├── Sortable.php
│   │   ├── HasTimestamps.php
│   │   └── HasUUID.php
│   │
│   ├── Casts/                      # Attribute Casts
│   │   ├── JsonCast.php
│   │   ├── EncryptedCast.php
│   │   └── BooleanCast.php
│   │
│   └── Providers/                  # Service Providers
│       ├── AppServiceProvider.php
│       ├── AuthServiceProvider.php
│       ├── BroadcastServiceProvider.php
│       ├── EventServiceProvider.php
│       ├── RouteServiceProvider.php
│       ├── RepositoryServiceProvider.php
│       ├── PaymentServiceProvider.php
│       └── ElasticsearchServiceProvider.php
│
├── config/                         # Configuration Files
│   ├── app.php
│   ├── auth.php
│   ├── broadcasting.php
│   ├── cache.php
│   ├── database.php
│   ├── filesystems.php
│   ├── hashing.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── sanctum.php
│   ├── session.php
│   ├── view.php
│   ├── payment-gateways.php        # Custom Payment Config
│   ├── commission.php              # Custom Commission Config
│   ├── elasticsearch.php           # Custom Search Config
│   ├── sms.php                     # Custom SMS Config
│   ├── email.php                   # Custom Email Config
│   └── platform.php                # Custom Platform Config
│
├── database/
│   ├── migrations/                 # Database Migrations
│   │   ├── 2024_01_01_000000_create_users_table.php
│   │   ├── 2024_01_01_000001_create_roles_table.php
│   │   ├── 2024_01_01_000002_create_permissions_table.php
│   │   ├── 2024_01_01_000003_create_vendors_table.php
│   │   ├── 2024_01_01_000004_create_tours_table.php
│   │   ├── 2024_01_01_000005_create_hotels_table.php
│   │   ├── 2024_01_01_000006_create_restaurants_table.php
│   │   ├── 2024_01_01_000007_create_bookings_table.php
│   │   ├── 2024_01_01_000008_create_payments_table.php
│   │   ├── 2024_01_01_000009_create_affiliates_table.php
│   │   ├── 2024_01_01_000010_create_reviews_table.php
│   │   ├── 2024_01_01_000011_create_messages_table.php
│   │   ├── 2024_01_01_000012_create_commissions_table.php
│   │   └── ... (40+ additional migration files)
│   │
│   ├── seeders/                    # Database Seeders
│   │   ├── DatabaseSeeder.php
│   │   ├── RoleSeeder.php
│   │   ├── PermissionSeeder.php
│   │   ├── UserSeeder.php
│   │   ├── VendorSeeder.php
│   │   ├── VendorTypeSeeder.php
│   │   ├── ListingSeeder.php
│   │   ├── BookingSeeder.php
│   │   ├── PaymentMethodSeeder.php
│   │   ├── CommissionRateSeeder.php
│   │   ├── CurrencySeeder.php
│   │   ├── CountrySeeder.php
│   │   ├── CitySeeder.php
│   │   └── AmenitySeeder.php
│   │
│   └── factories/                  # Model Factories
│       ├── UserFactory.php
│       ├── VendorFactory.php
│       ├── ListingFactory.php
│       ├── BookingFactory.php
│       ├── PaymentFactory.php
│       ├── ReviewFactory.php
│       ├── MessageFactory.php
│       └── AffiliateFactory.php
│
├── routes/                         # API Routes
│   ├── api.php                     # Main API Routes
│   ├── web.php                     # Web Routes
│   ├── broadcast.php               # WebSocket Routes
│   └── channels.php                # Broadcast Channels
│
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   ├── emails/
│   │   │   ├── welcome.blade.php
│   │   │   ├── booking-confirmation.blade.php
│   │   │   ├── payment-receipt.blade.php
│   │   │   └── notification.blade.php
│   │   └── errors/
│   │       ├── 404.blade.php
│   │       └── 500.blade.php
│   │
│   ├── lang/                       # Localization
│   │   ├── en/
│   │   │   ├── messages.php
│   │   │   ├── validation.php
│   │   │   └── auth.php
│   │   └── es/, fr/, de/, etc.
│   │
│   └── css/                        # Frontend Assets
│       └── app.css
│
├── storage/
│   ├── app/
│   │   ├── uploads/                # User Uploads
│   │   │   ├── avatars/
│   │   │   ├── listings/
│   │   │   ├── documents/
│   │   │   └── invoices/
│   │   ├── exports/                # File Exports
│   │   └── temp/                   # Temporary Files
│   │
│   ├── logs/                       # Application Logs
│   │   ├── laravel.log
│   │   ├── error.log
│   │   └── access.log
│   │
│   └── framework/                  # Framework Cache
│       ├── cache/
│       └── sessions/
│
├── tests/
│   ├── Feature/                    # Feature Tests
│   │   ├── Auth/
│   │   ├── Booking/
│   │   ├── Payment/
│   │   ├── Affiliate/
│   │   ├── Admin/
│   │   └── API/
│   │
│   ├── Unit/                       # Unit Tests
│   │   ├── Services/
│   │   ├── Models/
│   │   ├── Repositories/
│   │   └── Utilities/
│   │
│   ├── TestCase.php
│   └── CreatesApplication.php
│
├── bootstrap/
│   ├── app.php
│   └── cache/
│
├── .env.example                    # Environment Template
├── .env                            # Environment Variables
├── .env.testing                    # Testing Environment
├── .gitignore                      # Git Ignore
├── .editorconfig                   # Editor Config
├── composer.json                   # Composer Dependencies
├── composer.lock                   # Lock File
├── artisan                         # Artisan CLI
├── php.ini                         # PHP Configuration
├── nginx.conf                      # Nginx Config (if applicable)
├── docker-compose.yml              # Docker Compose
├── Dockerfile                      # Docker Image
└── README.md                       # Backend Documentation
```

---

## Documentation Structure (`/documentation`)

```
documentation/
├── GETTING_STARTED.md              # Quick Start Guide
├── ARCHITECTURE.md                 # Architecture Details
├── DATABASE_SCHEMA.md              # Database Design & ER Diagram
├── API_DOCUMENTATION.md            # Complete API Reference
├── SECURITY.md                     # Security Documentation
│
├── backend/
│   ├── SETUP.md                    # Backend Setup Guide
│   ├── FOLDER_STRUCTURE.md         # Backend Structure
│   ├── CODING_STANDARDS.md         # Code Standards
│   ├── MIGRATIONS.md               # Database Migration Guide
│   ├── TESTING.md                  # Testing Guide
│   ├── TROUBLESHOOTING.md          # Backend Troubleshooting
│   └── BEST_PRACTICES.md           # Backend Best Practices
│
├── frontend/
│   ├── SETUP.md                    # Frontend Setup Guide
│   ├── FOLDER_STRUCTURE.md         # Frontend Structure
│   ├── COMPONENT_GUIDE.md          # Component Documentation
│   ├── STYLING.md                  # Styling Guide
│   ├── HOOKS.md                    # Custom Hooks Guide
│   ├── TESTING.md                  # Frontend Testing
│   ├── PERFORMANCE.md              # Performance Tips
│   └── TROUBLESHOOTING.md          # Frontend Troubleshooting
│
├── api/
│   ├── AUTHENTICATION.md           # Authentication API
│   ├── USERS.md                    # User Endpoints
│   ├── VENDORS.md                  # Vendor Endpoints
│   ├── BOOKINGS.md                 # Booking Endpoints
│   ├── PAYMENTS.md                 # Payment Endpoints
│   ├── REVIEWS.md                  # Review Endpoints
│   ├── MESSAGES.md                 # Messaging Endpoints
│   ├── AFFILIATES.md               # Affiliate Endpoints
│   ├── SEARCH.md                   # Search Endpoints
│   ├── ADMIN.md                    # Admin Endpoints
│   └── WEBHOOKS.md                 # Webhook Documentation
│
├── deployment/
│   ├── DOCKER_DEPLOYMENT.md        # Docker Deployment
│   ├── CLOUD_DEPLOYMENT.md         # Cloud Setup (AWS/Azure/GCP)
│   ├── KUBERNETES.md               # Kubernetes Deployment
│   ├── CI_CD.md                    # CI/CD Pipeline Setup
│   ├── DATABASE_MIGRATION.md       # Database Migration
│   ├── BACKUP_RECOVERY.md          # Backup & Recovery
│   └── SCALING.md                  # Scaling Guide
│
├── operations/
│   ├── MONITORING.md               # Monitoring & Logging
│   ├── ALERTING.md                 # Alert Configuration
│   ├── BACKUP_STRATEGY.md          # Backup Strategy
│   ├── DISASTER_RECOVERY.md        # DR Plan
│   ├── SLA.md                      # Service Level Agreements
│   └── MAINTENANCE.md              # System Maintenance
│
├── business/
│   ├── COMMISSION_SYSTEM.md        # Commission Structure
│   ├── PAYMENT_PROCESSING.md       # Payment Processing
│   ├── AFFILIATE_PROGRAM.md        # Affiliate Program Guide
│   ├── VENDOR_ONBOARDING.md        # Vendor Onboarding
│   ├── FRAUD_PREVENTION.md         # Fraud Prevention
│   ├── COMPLIANCE.md               # Legal Compliance
│   └── REFUND_POLICY.md            # Refund Policy
│
├── images/
│   ├── architecture-diagram.png    # Architecture Diagram
│   ├── database-er-diagram.png     # ER Diagram
│   ├── deployment-diagram.png      # Deployment Diagram
│   └── flow-diagrams/              # Process Flow Diagrams
│
└── CHANGELOG.md                    # Version History
```

---

## Docker Configuration (`/docker`)

```
docker/
├── Dockerfile                      # Laravel Docker Image
├── Dockerfile.frontend             # React Docker Image
├── docker-compose.yml              # Docker Compose Setup
├── nginx/
│   ├── Dockerfile
│   └── nginx.conf
├── php/
│   ├── Dockerfile
│   ├── php.ini
│   └── supervisor.conf
├── mysql/
│   ├── Dockerfile
│   └── my.cnf
├── redis/
│   ├── Dockerfile
│   └── redis.conf
└── .env                            # Docker Environment
```

---

## Scripts (`/scripts`)

```
scripts/
├── setup.sh                        # Initial Setup Script
├── install-dependencies.sh         # Install All Dependencies
├── migrate-database.sh             # Run Database Migrations
├── seed-database.sh                # Seed Database
├── run-tests.sh                    # Run All Tests
├── build-docker.sh                 # Build Docker Images
├── deploy.sh                       # Deployment Script
├── backup.sh                       # Backup Database
├── restore.sh                      # Restore Database
├── cleanup.sh                      # Cleanup Temp Files
└── README.md                       # Scripts Documentation
```

---

## GitHub Configuration (`/.github`)

```
.github/
├── workflows/
│   ├── tests.yml                   # Automated Testing
│   ├── build.yml                   # Build Pipeline
│   ├── deploy-staging.yml          # Deploy to Staging
│   ├── deploy-production.yml       # Deploy to Production
│   └── code-quality.yml            # Code Quality Checks
│
├── CONTRIBUTING.md                 # Contributing Guidelines
├── PULL_REQUEST_TEMPLATE.md        # PR Template
├── ISSUE_TEMPLATE/
│   ├── bug_report.md
│   ├── feature_request.md
│   └── documentation.md
│
└── CODE_OF_CONDUCT.md              # Code of Conduct
```

---

## Key Files at Root Level

```
TravelHub/
├── .gitignore                      # Git Ignore Rules
├── .env.example                    # Environment Template
├── README.md                       # Project Overview
├── LICENSE                         # License File
├── CONTRIBUTING.md                 # Contributing Guidelines
├── CHANGELOG.md                    # Version History
├── SYSTEM_ARCHITECTURE.md          # Architecture Overview
├── FOLDER_STRUCTURE.md             # This File
├── DATABASE_SCHEMA.md              # Database Design
├── API_DOCUMENTATION.md            # API Reference
├── DEPLOYMENT_GUIDE.md             # Deployment Instructions
├── DEVELOPMENT_SETUP.md            # Setup Instructions
├── docker-compose.yml              # Docker Compose
├── Dockerfile                      # Docker Image
└── .editorconfig                   # Editor Configuration
```

---

**Total Structure Summary**:
- **Frontend**: 100+ files/folders (React components, layouts, pages)
- **Backend**: 150+ files/folders (Controllers, Models, Services, Migrations)
- **Documentation**: 40+ markdown files
- **Configuration**: 20+ config files
- **Tests**: 50+ test files

This comprehensive structure follows enterprise best practices and is ready for development on XAMPP, Docker, or cloud deployment.

---

**Last Updated**: 2026-05-31
**Status**: Phase 1 Complete
