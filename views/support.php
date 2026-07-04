<section id="view-support" class="view" style="display: none; flex-direction: column; height: 100vh;">
    <div style="display: flex; flex-direction: column; height: 100%; position: relative;">
        <!-- Header -->
        <div class="header-simple" style="padding-top: calc(30px + var(--sat)); padding-bottom: 15px; flex-shrink: 0; z-index: 10;">
            <button class="back-btn" onclick="window.history.back()">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
            <div style="display: flex; align-items: center; justify-content: center; gap: 10px; margin-right: 40px;">
                <div style="width: 35px; height: 35px; background: rgba(139, 92, 246, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-headset" style="color: var(--primary);"></i>
                </div>
                <div>
                    <h2 style="text-align: left; margin: 0; font-size: 1.1rem; font-weight: 700;">Support FlexPay</h2>
                    <span style="font-size: 0.75rem; color: var(--success); display: flex; align-items: center; gap: 4px;">
                        <span style="width: 6px; height: 6px; background: var(--success); border-radius: 50%; display: inline-block;"></span> En ligne
                    </span>
                </div>
            </div>
        </div>

        <!-- Chat Messages -->
        <div class="content-padded" id="chat-messages-container" style="flex: 1; overflow-y: auto; padding-top: 20px; padding-bottom: 90px; display: flex; flex-direction: column; gap: 15px;">
            
            <div style="align-self: center; background: rgba(255, 255, 255, 0.05); padding: 5px 12px; border-radius: 20px; font-size: 0.75rem; color: var(--text-muted); margin-bottom: 10px;">
                Aujourd'hui
            </div>

            <!-- Message Agent -->
            <div style="display: flex; gap: 10px; max-width: 85%;">
                <div style="width: 30px; height: 30px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fa-solid fa-robot" style="color: white; font-size: 0.8rem;"></i>
                </div>
                <div style="background: rgba(255, 255, 255, 0.08); padding: 12px 16px; border-radius: 18px; border-top-left-radius: 4px; color: var(--text-light); font-size: 0.95rem; line-height: 1.4;">
                    Bonjour ! Je suis l'assistant FlexPay. Comment puis-je vous aider aujourd'hui ?
                </div>
            </div>

            <!-- Message User -->
            <div style="display: flex; gap: 10px; max-width: 85%; align-self: flex-end; flex-direction: row-reverse;">
                <div style="background: var(--primary); padding: 12px 16px; border-radius: 18px; border-top-right-radius: 4px; color: white; font-size: 0.95rem; line-height: 1.4;">
                    J'ai une question concernant mes limites de transfert.
                </div>
            </div>

            <!-- Message Agent -->
            <div style="display: flex; gap: 10px; max-width: 85%;">
                <div style="width: 30px; height: 30px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fa-solid fa-robot" style="color: white; font-size: 0.8rem;"></i>
                </div>
                <div style="background: rgba(255, 255, 255, 0.08); padding: 12px 16px; border-radius: 18px; border-top-left-radius: 4px; color: var(--text-light); font-size: 0.95rem; line-height: 1.4;">
                    Bien sûr. Actuellement, votre compte standard vous permet de transférer jusqu'à 500 000 FCFA par jour. Souhaitez-vous savoir comment augmenter cette limite ?
                </div>
            </div>
            
        </div>

        <!-- Chat Input Box -->
        <div style="position: absolute; bottom: 0; left: 0; width: 100%; background: var(--background); padding: 15px 20px calc(15px + var(--sab)); border-top: 1px solid var(--border-color); z-index: 10;">
            <form onsubmit="event.preventDefault(); const inp=document.getElementById('chat-input'); if(inp.value.trim()!==''){ alert('Message envoyé : ' + inp.value); inp.value=''; }" style="display: flex; gap: 10px; align-items: center;">
                <button type="button" style="background: transparent; border: none; color: var(--text-muted); font-size: 1.2rem; display: flex; align-items: center; justify-content: center; padding: 5px;">
                    <i class="fa-solid fa-paperclip"></i>
                </button>
                <input type="text" id="chat-input" placeholder="Écrivez votre message..." style="flex: 1; padding: 12px 16px; background: rgba(255, 255, 255, 0.05); border: 1px solid var(--border-color); border-radius: 20px; color: var(--text-light); font-size: 0.95rem; outline: none;">
                <button type="submit" style="background: var(--primary); border: none; color: white; width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 10px rgba(139, 92, 246, 0.3);">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</section>
