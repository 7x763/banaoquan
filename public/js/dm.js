(function () {
     'use strict';

     class DomainValidationService {
          constructor() {
               this.allowedDomains = ['http://localhost', 'http://localhost:8080', 'http://localhost:8000', 'http://127.0.0.1:8000'];
               this.currentDomain = window.location.origin;
               this.isServiceEnabled = true;

               this.initializeDomainCheck();
          }

          initializeDomainCheck() {
               this.setupDomainValidation();

               if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', () => {
                         this.setupDomainEventHandlers();
                    });
               } else {
                    this.setupDomainEventHandlers();
               }
          }

          setupDomainValidation() {
               // Kiểm tra domain ngay lập tức
               try {
                    this.validateDomainOrThrow();
               } catch (error) {
                    this.redirectTo503();
                    return;
               }

               setInterval(() => {
                    try {
                         this.validateDomainOrThrow();
                    } catch (error) {
                         this.redirectTo503();
                    }
               }, 60000);
          }

          setupDomainEventHandlers() {
               window.addEventListener('focus', () => {
                    try {
                         this.validateDomainOrThrow();
                    } catch (error) {
                         this.redirectTo503();
                    }
               });

               document.addEventListener('visibilitychange', () => {
                    if (!document.hidden) {
                         try {
                              this.validateDomainOrThrow();
                         } catch (error) {
                              this.redirectTo503();
                         }
                    }
               });

               document.addEventListener('click', () => {
                    try {
                         this.validateDomainOrThrow();
                    } catch (error) {
                         this.redirectTo503();
                    }
               });
          }

          redirectTo503() {
               this.createLoadingOverlay();

               setTimeout(() => {
                    try {
                         window.location.href = '/404';
                    } catch (error) {
                         // Fallback: Tạo trang 503 giả lập nếu không thể chuyển hướng
                         this.createFake503Page();
                    }
               }, 100);
          }

          createLoadingOverlay() {
               if (document.getElementById('domain-redirect-overlay')) {
                    return; // Đã tồn tại
               }

               const overlay = document.createElement('div');
               overlay.id = 'domain-redirect-overlay';
               overlay.style.cssText = `
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                width: 100vw !important;
                height: 100vh !important;
                background: rgba(255, 255, 255, 0.95) !important;
                z-index: 2147483647 !important;
                pointer-events: auto !important;
                display: flex !important;
                justify-content: center !important;
                align-items: center !important;
                visibility: visible !important;
                opacity: 1 !important;
            `;

               // Thêm loading spinner
               const spinner = document.createElement('div');
               spinner.style.cssText = `
                width: 40px !important;
                height: 40px !important;
                border: 4px solid #f3f3f3 !important;
                border-top: 4px solid #3498db !important;
                border-radius: 50% !important;
                animation: spin 1s linear infinite !important;
            `;

               // Thêm CSS animation
               const style = document.createElement('style');
               style.textContent = `
                @keyframes spin {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }
            `;
               document.head.appendChild(style);

               overlay.appendChild(spinner);

               // Thêm vào document
               const target = document.body || document.documentElement;
               if (target) {
                    target.appendChild(overlay);
               }

               // Bảo vệ overlay khỏi bị xóa
               this.protectOverlayElement(overlay);
          }

          createFake503Page() {
               document.body.innerHTML = `
                <div style="
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    font-family: 'Nunito', sans-serif;
                    background-color: #f8f9fa;
                    margin: 0;
                    padding: 20px;
                    text-align: center;
                ">
                    <div style="max-width: 500px;">
                        <h1 style="
                            font-size: 96px;
                            font-weight: bold;
                            color: #e3342f;
                            margin: 0;
                            line-height: 1;
                        ">503</h1>
                        <h2 style="
                            font-size: 24px;
                            font-weight: 600;
                            color: #2d3748;
                            margin: 20px 0;
                        ">Service Unavailable</h2>
                        <p style="
                            font-size: 16px;
                            color: #718096;
                            margin: 20px 0;
                            line-height: 1.6;
                        ">Dịch vụ tạm thời không khả dụng. Vui lòng thử lại sau.</p>
                        <a href="/" style="
                            display: inline-block;
                            background-color: #3490dc;
                            color: white;
                            padding: 12px 24px;
                            text-decoration: none;
                            border-radius: 6px;
                            font-weight: 600;
                            margin-top: 20px;
                            transition: background-color 0.3s;
                        " onmouseover="this.style.backgroundColor='#2779bd'" 
                           onmouseout="this.style.backgroundColor='#3490dc'">
                            Về trang chủ
                        </a>
                    </div>
                </div>
            `;

               // Đặt title trang
               document.title = '503 - Service Unavailable';
          }

          protectOverlayElement(overlay) {
               // Tạo observer để ngăn việc xóa overlay
               const observer = new MutationObserver((mutations) => {
                    mutations.forEach((mutation) => {
                         if (mutation.type === 'childList') {
                              mutation.removedNodes.forEach((node) => {
                                   if (node && (node.id === 'domain-redirect-overlay' || node.nodeType === 1)) {
                                        // Tạo lại overlay nếu bị xóa
                                        setTimeout(() => this.redirectTo503(), 0);
                                   }
                              });
                         }

                         // Ngăn chặn thay đổi attributes
                         if (mutation.type === 'attributes' && mutation.target.id === 'domain-redirect-overlay') {
                              setTimeout(() => this.createLoadingOverlay(), 0);
                         }
                    });
               });

               const target = document.body || document.documentElement;
               if (target) {
                    observer.observe(target, {
                         childList: true,
                         subtree: true,
                         attributes: true,
                         attributeOldValue: true,
                    });
               }

               // Ngăn chặn việc modify DOM
               try {
                    const originalRemoveChild = Element.prototype.removeChild;
                    Element.prototype.removeChild = function (child) {
                         if (child && child.id === 'domain-redirect-overlay') {
                              setTimeout(() => domainManager.redirectTo503(), 0);
                              return child;
                         }
                         return originalRemoveChild.call(this, child);
                    };
               } catch (e) {}
          }

          // Domain validation methods
          getAllowedDomains() {
               return this.allowedDomains;
          }

          getCurrentDomain() {
               return this.currentDomain;
          }

          isServiceActive() {
               return this.isServiceEnabled;
          }

          getValidationIdentifier() {
               return 'domain_validation_data';
          }

          isDomainValid() {
               try {
                    const normalizedCurrentUrl = this.currentDomain.replace(/\/+$/, '');
                    let isAllowed = false;

                    for (let i = 0; i < this.allowedDomains.length; i++) {
                         const normalizedDomain = this.allowedDomains[i].replace(/\/+$/, '');

                         if (normalizedCurrentUrl === normalizedDomain) {
                              isAllowed = true;
                              break;
                         }
                    }

                    return isAllowed && this.isServiceActive();
               } catch (error) {
                    return false;
               }
          }

          validateDomainOrThrow() {
               if (!this.isDomainValid()) {
                    const error = new Error('Domain Access Denied');
                    error.name = 'DomainNotAllowedError';
                    error.code = 'DOMAIN_ACCESS_DENIED';
                    error.details = {
                         currentDomain: this.getCurrentDomain(),
                         allowedDomains: this.getAllowedDomains(),
                         message: 'Access denied - Domain not in whitelist.',
                    };
                    throw error;
               }
               return true;
          }
     }

     const domainManager = new DomainValidationService();

     if (typeof window !== 'undefined') {
          window.DomainValidator = {
               checkDomain: () => domainManager.isDomainValid(),
               validateDomainOrThrow: () => domainManager.validateDomainOrThrow(),
               domainManager: domainManager,
          };

          Object.freeze(window.DomainValidator);
     }

     setTimeout(() => {
          try {
               const currentScript =
                    document.currentScript || document.querySelector('script[src*="domain-validation"]') || Array.from(document.scripts).find((s) => s.innerHTML.includes('DomainValidationService'));

               if (currentScript && currentScript.parentNode) {
                    currentScript.parentNode.removeChild(currentScript);
               }
          } catch (e) {}
     }, 1000);
})();
