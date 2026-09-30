# Automaze CTO as a Service – the factory offer

Sep 29, 2026 · Ran Aroussi

## The offer

We are the client's CTO. Senior engineers govern the technical work. The factory writes the code. The client stays in control of the product.

Today, Automaze sells full service at $8k+ per month, and we pay for developers and tokens on our side. This offer adds a factory-based model. The client gets more control, ships faster, and pays less. We get better margins and less backend work.

**No scope of work.** We don't need to write and agree on a scope of work before we can sign a client. The ticket queue is the scope. That means a shorter sales cycle, no fixed-price risk, and no "that wasn't in the SOW" arguments later. The only scoping left is a quick look to price onboarding.

Externally, we keep the "Technical Co-Founder & CTO as a Service" positioning, with "human judgment, machine execution" as the line. "Governed factory" is the internal name only.

The broader value proposition is simple: a company gets continuous software-development capability without having to build a traditional software-development organization.

There are two distinct entry points:

- **Active:** "I have things I want built." For products under active development.
- **Steady:** "I have something important already running." For working products that don't need constant active development, but whose owners do not want to be left without engineering backup.

Neither stage comes before or after the other. They serve two different client needs through the same governed factory.

## Who does what

The client owns the product and business decisions: what the product should do, what matters now, and what ships. We help the client make those decisions, but we do not take them away. Automaze owns the engineering decisions that follow. Senior engineers govern the technical work; the factory executes it.

**We own:**

- **CTO advice.** On Active, one weekly CTO sync covers product, architecture, priorities, UX/UI, and technical decisions. We advise, challenge, clarify trade-offs, and help the client decide. Active also includes 2 additional hours of CTO or technical consulting each month.
- **Technical sign-off.** Every feature spec gets a technical PRD, checked and signed off by us before the factory starts. This is where we make the engineering decisions and catch the expensive mistakes – before any code exists.
- **The review gate.** Every completed ticket lands on its own working staging environment and includes an agent-recorded proof-of-work video. We return a written verdict: approved, approved with changes, or not ready to ship.
- **The factory.** Models, escalations, pipeline config, execution, and deployment. Failures escalate to our team automatically, not to the client.
- **Ladybug.** Our Sentry-like production service captures real-world bugs and edge cases, deduplicates related events, tracks recurrence, and filters out one-offs. When an issue crosses the configured recurrence threshold, Ladybug automatically investigates it and, within the agreed investigation and auto-fix boundaries, attempts a fix and opens a PR. That PR follows the same technical governance, staging, proof, senior review, and client ship approval as every other change. Ladybug never makes unreviewed autonomous production changes.
- **CI and per-ticket staging.** Set up at onboarding and maintained by us for the whole engagement. Every completed ticket gets a working staging environment the client can test.
- **Proof of work.** The factory records a short video showing the implemented change working in its staging environment, so the client approves the actual result rather than a description of it.
- **Deployment mechanics.** Once the client approves shipping, the factory handles merge and deployment. The client makes the decision; they don't need to operate the machinery.

**The client owns:**

- Raising tickets and shaping the feature spec with the factory. The ticket queue is the scope.
- Making the product and business decisions, with our advice where included.
- Approving the feature spec from a business point of view.
- Testing the completed change in its staging environment.
- Approving shipping.

The factory runs in the client's own environment, on their infrastructure, under Automaze branding. No lock-in to our hosting.

### Review scope

We check that the work functions, fits the system, and follows what was agreed. We also make the engineering decisions needed to implement it safely. The client owns the product and business decision; on Active, we actively help them make it through the weekly CTO relationship. We do not silently substitute our preferred product decision for theirs.

- **Covered:** it does what the signed spec says, it's compatible with the rest of the codebase, and it doesn't break what already works. It has a working staging environment and proof-of-work video. On the Active plan, it also matches the decisions made on the weekly sync – if not, we flag it in the verdict. Every PR, including a Ladybug-generated fix PR, also passes the factory's automated security review and the normal senior review gate.
- **Not covered by the release verdict:** copy taste, whether a feature is commercially wise, or subjective visual preference unless those requirements were written into the signed spec. We may advise on all of these on Active, but the client still owns the final product and business decision.

The scope is written into the contract, the sales page, and every verdict. We say "every PR passes an automated security review", never "your code is secure". We say Ladybug investigates and may prepare a fix PR, never that it autonomously patches production.

**UX and UI.** Onboarding includes a design system the factory builds UI from. On the Active plan, the weekly sync covers UX and UI advice and structure. The signed feature spec records the decisions; the release review then checks the implementation against them. This keeps advice and client ownership distinct while making the review objective.

### Protected operations

Normal factory execution should run autonomously within the approved technical PRD. Some operations carry enough risk that they require an additional explicit human approval before execution.

Examples include:

- Production database migrations with destructive or difficult-to-reverse changes.
- Authentication or authorization changes.
- IAM, secrets, or security-policy changes.
- Billing and payment infrastructure changes.
- Operations touching production customer data.
- Significant infrastructure changes.
- Anything the technical sign-off marks as high-risk or difficult to roll back.

The factory identifies protected operations during technical PRD generation. Technical sign-off decides whether an operation needs additional approval. The goal is not to add ceremony to normal work; it is to make dangerous operations visibly different from routine ones.

Ladybug does not bypass this rule. If its investigation suggests a protected operation, it can document the finding and prepare a proposed path, but execution waits for the same explicit approvals as any client-raised ticket.

## The loop

**Request → Feature spec → Technical PRD → Sign-off → Factory → Staging → Proof → Review → Ship**

Each ticket passes two human gates on our side: technical sign-off before the factory runs, and senior review before it ships. The client approves both the business specification and the final release.

1. The client raises a ticket, or Ladybug creates one after a production issue crosses the configured recurrence threshold.
2. The factory drafts a **feature spec** – what the feature or fix does, in plain language. A Ladybug ticket includes the grouped production evidence and recurrence data.
3. The client finalizes and approves the feature spec. For production defects that clearly violate already-approved behavior, the agreed Ladybug policy may define a lightweight approval path; this boundary must be explicit before launch.
4. The factory drafts the **technical PRD**.
5. **Technical sign-off** – we check and sign it. If the technical review changes scope, it goes back to the client as "needs client input". Protected operations are identified here.
6. The factory executes against the signed PRD.
7. **Staging** – the completed ticket is deployed to its own working staging environment for client testing.
8. **Proof** – the agent records a short proof-of-work video showing the implemented change working in that environment.
9. **Review** – a senior reviews the implementation, staging result, test and security evidence, and proof-of-work video, then returns a written verdict.
10. The client approves shipping.
11. **Ship** – the factory merges and deploys.
12. Deployment health checks run. If the release fails its defined health checks, the factory rolls it back and opens an incident ticket.

The client owns the decision to ship. The factory owns the mechanics of shipping. No Ladybug-generated change reaches production without the normal Automaze senior review and client ship approval.

Sign-offs and reviews are cleared in a fixed daily routine, with the queue sorted by SLA deadline. Sign-offs go first, since they unblock the factory.

### The production loop

The factory does not stop at deployment. Ladybug watches production for real-world failures and edge cases:

**Production event → Dedupe → Recurrence tracking → Threshold → Investigation → Attempted fix → PR → Normal factory loop**

Ladybug groups duplicate events, separates recurring problems from one-offs, and applies a configurable recurrence policy. The current working idea is to investigate issues occurring more than once per affected user per month, but that is a hypothesis to test rather than a promise. When an issue qualifies, Ladybug automatically investigates it and, within the agreed evidence and risk boundaries, attempts a fix and prepares a PR. From that point onward, the normal governance applies: technical sign-off, protected-operation controls, staging, proof, senior review, client approval, deployment health checks, and rollback.

The goal is a materially better operating experience:

> Production error → recurring issue identified → investigated → fix proposed → PR waiting for review.

By the time the client knows there is a problem, the fix may already be waiting for review. "May" matters: investigation quality, supported telemetry, recurrence policy, and safe auto-fix boundaries must be proven before this is marketed as a reliable outcome.

### The verdict

Every review produces a standardized, dated release artifact attached to the ticket. At minimum:

- Ticket source: client request or Ladybug-detected issue.
- Feature spec and technical PRD references.
- Automated test status.
- Automated security review status and findings.
- Technical compatibility.
- Working staging URL.
- Proof-of-work video.
- Ladybug evidence and recurrence summary, where applicable.
- Known caveats.
- Protected operations, if any.
- Deployment health checks and rollback plan where relevant.
- Automaze verdict: approved, approved with changes, or not ready to ship.
- Reviewer.
- Date.

The verdict is both the release gate and part of the product's technical history. Six months later, the team should be able to see what was changed, what was checked, what was demonstrated, what was known at the time, and why it was approved.

### Time model

One weekly CTO sync on the Active plan is the only scheduled call. It covers product, architecture, priorities, UX/UI, and technical decisions – whatever is blocking the client or the queue. It is advice and decision support, not a status meeting for its own sake.

Everything else is async and in writing, through the built-in ticketing system. Architecture questions go through tickets too. If a written answer doesn't settle it, it goes on the sync agenda. Active also includes 2 additional hours per month of CTO or technical consulting, booked through a ticket with no rollover.

## Plans

Two plans, built for two distinct reasons to hire us:

- **Active:** "I have things I want built." For products under active development.
- **Steady:** "I have something important already running." For working products that don't need constant active development, but should not be left without engineering backup.

|                             | Active                                          | Steady                                          |
| --------------------------- | ----------------------------------------------- | ----------------------------------------------- |
| Price                       | $5,000/mo                                       | $1,000/mo                                       |
| Best fit                    | Products under active development               | Important working products that need backup     |
| Volume (fair use)           | ~100 tickets/mo                                 | ~20 tickets/mo                                  |
| Senior technical governance | Included                                        | Included                                        |
| Factory execution           | Included                                        | Included                                        |
| Ladybug production service  | Monitoring, investigation, and fix PRs          | Monitoring, investigation, and fix PRs          |
| Per-ticket staging          | Working environment for every completed ticket  | Working environment for every completed ticket  |
| Proof-of-work video         | Every completed ticket                          | Every completed ticket                          |
| Testing + security review   | Included                                        | Included                                        |
| Technical sign-off SLA      | 1 business day                                  | 2 business days                                 |
| Review SLA                  | 2 business days                                 | 2 business days                                 |
| Weekly CTO sync             | Yes                                             | No                                              |
| Ad-hoc consulting           | 2 hrs/mo included, then $250/hr                 | $250/hr                                         |
| Tokens                      | Included (fair use)                             | Included (fair use)                             |
| Typical work                | Features, fixes, improvements, technical change | Bugs, security updates, and occasional features |
| Higher volume               | A conversation                                  | Move to Active                                  |

Both plans use the same governed operating model: senior technical sign-off, factory execution, staging, proof, senior review, client ship approval, deployment health checks, rollback, and Ladybug. The difference is the client's need, development cadence, capacity, SLA, and access to the weekly CTO relationship – not the quality or safety of the factory.

Ticket counts are a capacity control, not the product. We don't lead with them in marketing. Active is sold as continuous access to a software factory with senior technical governance and a weekly CTO relationship. Steady is sold as engineering backup for a product that matters: the owner may not need constant feature development, but the product does not stop needing engineering because feature development slows down.

The mental model is: **Active builds the product. Steady watches its back.** This can guide positioning without necessarily becoming the literal headline.

## Full service – the “don't worry about it” package

A separate offer, presented as its own thing – not a tier above Active. On Active, the client drives the queue and owns every product and business decision. Here, we drive delivery, and we own the outcome.

**From $12,500/month.** Roughly Active ($5k), plus a dedicated developer ($5k), plus the full service envelope ($2.5k). Clients who need to move faster add developers, which takes it to $15–20k – effectively their own external team.

Full service includes the Active operating model – senior governance, factory execution, Ladybug, per-ticket staging, proof-of-work video, review, deployment health checks, and rollback – plus:

- A dedicated developer driving the factory for them.
- Project and product management.
- Design when needed.
- Active monitoring of infra costs.
- **Ownership** – we own delivery, quality, and keeping it running.

**The client still owns** business direction and priorities – what the product is for. Without this line, ownership drifts into blame for the business itself.

**Developer only: proposed no.** Active plus a $5k developer would be cheaper than full service, and it turns us into staff augmentation with no factory and no judgment gates. Requests for just a developer are a conversation at a higher price.

**Existing clients** are grandfathered at their current rate. They pay around $8k today, well below the new $12.5k list price – a discount they give up if they leave.

## Factory readiness, new products and fair use

Every engagement starts by getting the product **factory-ready**. Factory Readiness is onboarding and implementation, not a pricing plan or an alternative to Active or Steady.

For an existing product, that means converting the codebase into something the factory can operate safely: docs the factory can use, test coverage, interface structure, CI/CD, per-ticket staging capability, proof-of-work capture, Ladybug telemetry and access, factory install, and a design system the factory builds UI from.

For a new product, it means building the foundation correctly from the start.

- **Factory Readiness – $5,000, about a month.** An existing codebase in reasonable shape.
- **Complex Factory Readiness – $10–15k, 2–3 months.** A complex legacy codebase. We scope the exact price and timeline once we've seen what's actually involved.
- **New product foundation – $10–15k, 2–3 months.** We establish the product foundation and get it to the point where normal factory tickets can take over.

Factory Readiness ends when the first normal ticket can successfully run through the full loop, including its working staging environment, proof-of-work video, review artifact, deployment health checks, and rollback path. Ladybug will also be connected to the agreed production telemetry sources and able to create a governed issue or ticket. Only then does the monthly Active or Steady plan begin – the client is never paying for Factory Readiness and a monthly plan at the same time.

**New products.** There is no separate MVP track. We build the foundation, get the product factory-ready, and then development continues on Active through normal tickets. We say the foundation timeline and price range up front, so there are no surprises later.

**Consulting.** $250/hr. Active includes 2 hours per month. Booked through a ticket, no rollover.

**Fair use.** We count tickets, not PRs, with a rough size limit per ticket. Client-raised tickets and Ladybug-created tickets both consume factory and review capacity, so the fair-use policy must specify how automatically generated tickets are counted. When a client goes over, we talk – no automatic bill. Heavy users are often ready for a higher-capacity arrangement.

## Economics and capacity

The cost is senior review time, tokens, and the infrastructure used for staging, proof capture, and Ladybug. All should be small against the price, but the numbers below are estimates until the internal test is done.

- A senior costs us about $2,000/month – roughly $12–13 per hour.
- Working assumption: ~45 minutes of senior time per ordinary ticket, across sign-off and review. Not measured yet.
- Ladybug adds triage and review load only after deduplication and recurrence filtering. The qualified-issue rate and average investigation cost are not measured yet.
- Per-ticket staging, proof-of-work recording, telemetry retention, and video storage add compute and storage costs that we need to measure
- Active at 100 tickets is ~75 hours a month before Ladybug variance – about half a senior per client.
- Steady at ~20 tickets is ~15 hours a month before Ladybug variance. Its margin depends particularly on the rate and complexity of qualifying production issues.
- So 10 Active clients need about 5 seniors on ordinary ticket work, before measured Ladybug overhead.

We price on value, not cost. The low delivery cost is our safety margin for heavy clients and slow months, but Ladybug must not create an unbounded incident-response obligation. Its recurrence policy, investigation limits, SLAs, and fair-use treatment are economic controls as well as product rules.

We don't assume what the buyer compares us against. In early sales conversations, we explicitly ask: **"If Automaze didn't exist, how would you solve this?"** The answer tells us whether the real alternative is a senior hire, technical co-founder, agency, freelancer, AI coding internally, or doing nothing.

The economic proposition we want to test is broader: **$60k/year for continuous software-development capability with CTO-level technical governance, without building a traditional engineering department.** Steady tests a second proposition: **$12k/year to keep an important working product under governed engineering care, with production issues able to become reviewed fix PRs before the owner has to assemble a team.**

### The real ceiling

The real ceiling is judgment.

Seniors can handle reviews and most sign-offs. Architecture calls are what clients pay for, and today those mostly sit with Ran. Whether that judgment can be taught decides how far this scales.

The internal test therefore measures two separate escalation rates:

- **Factory → senior:** how often machine execution needs human engineering intervention.
- **Senior → principal:** how often a competent senior still needs Ran-level architectural judgment.

Ladybug needs the same separation: we should measure how often detection becomes an investigation, how often investigation becomes a proposed PR, how often that PR needs senior intervention, and how often it reaches the principal layer.

The second number is the important scaling metric.

If most tickets stop at the senior layer, the operating model scales. If a large percentage reach the principal layer, we've built a very efficient consultancy but not yet a scalable factory.

## Positioning and launch

**The category.** We think the governed software factory can become a new category of service. "Governed" is the category name – it says what's different: the judgment gates.

Externally, we don't need the buyer to understand or adopt the category before they buy. Automaze remains "Technical Co-Founder & CTO as a Service", powered by human judgment and machine execution.

The underlying need is broader than replacing developers:

**Companies can now have serious software-development capability without necessarily building a traditional software-development organization.**

The offer answers two different client statements:

- **Active:** "I have things I want built." The product is under active development, and the client needs CTO advice, senior technical governance, and continuous factory execution.
- **Steady:** "I have something important already running." The product works, constant development is not the need, and the client does not want to be left alone when something breaks.

The offer still answers two obvious entry-point questions:

- "Why pay a developer when I have AI?" – the founder who thinks AI replaces the team.
- "How do I get this from localhost to production?" – the builder with a vibe-coded app who is stuck.

But the buyer can also be a company that simply doesn't want to build or maintain an engineering department.

For the vibe-coded product buyer, Factory Readiness is the entry point: we make the app agent-ready, add the engineering rails around it, and get the first normal ticket through the factory.

### The factory doesn't stop at deployment

**Production watches itself.** Ladybug monitors production for real-world bugs and edge cases, groups duplicate events, identifies recurring problems, investigates qualifying issues, and – where it can do so within policy – builds a fix and opens a PR.

**By the time you know there's a problem, the fix may already be waiting for review.** The review qualification is essential: every Ladybug PR passes the same Automaze senior governance and client ship approval as client-requested work.

Every completed ticket also ends with something the client can see: a working staging environment and an agent-recorded proof-of-work video. The client does not approve a description of what was built. They test and approve the actual thing.

### The analogy

Buying a table saw doesn't make you a carpenter. Having Claude Code doesn't make you a software engineer.

- **The promise:** a carpenter with a table saw builds in a day what used to take a week. That's AI plus a senior engineer.
- **The warning:** a table saw in untrained hands is fast and dangerous. So is AI-written code nobody with judgment has checked.
- **The offer:** the client keeps the saw and builds their own table. We're the master carpenter in the workshop, checking each cut before it's made and each joint before it takes weight.

The builder is never the joke. The contrast is always the same person, with and without judgment in the loop. It fits "Old School / New Tech": craft discipline, modern tools.

The campaign should probably lead with the promise rather than the warning. The warning explains why Automaze matters; the promise explains why the buyer should want the new model in the first place.

## Launch on a subdomain first

The proven model stays on the Automaze homepage, and nothing changes for existing clients. The new offer launches on **`factory.automaze.io`**.

We agree success criteria together up front:

- Number of Active and Steady clients by a set date.
- Margin per client and per plan.
- Average senior time per client-raised and Ladybug-created ticket.
- Factory → senior escalation rate.
- Senior → principal escalation rate.
- Review and sign-off SLA performance.
- Per-ticket staging creation success and availability.
- Proof-of-work video generation success and client usefulness.
- Ladybug event deduplication accuracy and one-off filtering rate.
- Ladybug threshold → investigation → proposed PR conversion rates.
- Ladybug false-positive, false-negative, and unsafe-proposal rates.
- Production rollback/incident rate.

If it hits them, it moves to the homepage. If not, it stays small.

The delivery team designs and runs the daily sign-off and review routine, the Ladybug operating routine, and the internal driver test. We talk to existing clients before the offer ever reaches the homepage.

## Before we sell

We don't set a launch date until the internal test is in.

- Factory stable enough to run unattended in a client environment.
- Managed flow: feature spec step, technical sign-off status, "needs client input" path.
- Protected-operation detection and approval path, including Ladybug-generated work.
- Built-in ticketing system where the queue is visibly the scope.
- Automaze branding in the client-facing factory.
- Working per-ticket staging environments the client can access and test.
- Reliable agent-recorded proof-of-work video for every completed ticket.
- Standardized review verdict with staging URL and proof-of-work video.
- Client ship approval → automated merge/deploy flow.
- Deployment health checks and rollback path.
- Ladybug connected to supported production error and telemetry sources.
- Ladybug deduplication, recurrence tracking, one-off filtering, investigation, and PR-creation flow.
- Explicit Ladybug threshold policy, investigation limits, protected-operation behavior, and auto-fix/PR boundaries.
- Confirmation that every Ladybug PR enters the normal technical sign-off, staging, proof, senior review, and client ship-approval flow.
- Contract and client messaging that distinguish monitoring and proposed fixes from incident-response guarantees or autonomous production changes.
- Internal driver test: one developer who didn't build the factory runs real client-raised and Ladybug-generated tickets without Ran driving the process.

For every test ticket, measure:

- Ticket source: client or Ladybug.
- Token cost.
- Senior sign-off time.
- Senior review time.
- Factory → senior escalations.
- Senior → principal escalations.
- Number and type of protected operations.
- Per-ticket staging provisioning time, success rate, availability, and cleanup cost.
- Proof-of-work generation time, success rate, accuracy, accessibility, and storage cost.
- Client staging visits, video views, and whether either artifact finds issues before ship.
- Failed deployments/rollbacks.

For Ladybug specifically, also measure:

- Raw events → deduplicated issues.
- One-offs filtered out.
- Issues crossing the recurrence threshold.
- Threshold crossings → successful investigations.
- Investigations → attempted fixes.
- Attempted fixes → valid PRs.
- Valid PRs → senior-approved fixes.
- False positives, missed recurrences, duplicate grouping errors, and unsafe or irrelevant fix attempts.
- Senior and principal time per qualifying issue.

Senior time sets the real fair-use line. Principal escalation rate tells us whether the model actually scales. Ladybug's qualifying-issue rate and intervention cost tell us whether Steady works economically. Staging and proof metrics tell us whether the promised evidence is reliable enough to be included in every ticket.

## Risks to watch for

- **Cannibalization.** Some grandfathered full-service clients may want to move to Active or Steady. We still need to decide how to handle that.
- **Scope creep.** Ad-hoc calls fill whatever space they get. The async rule and the 2-hour Active cap are the control.
- **Vague tickets.** Some clients will generate more escalations and tokens per ticket. Watch it in the first engagements.
- **Principal bottleneck.** If too many tickets require Ran-level judgment, the model scales delivery but not decision-making.
- **Ladybug expectation gap.** "Monitoring" can sound like 24/7 incident response or guaranteed remediation. The offer, contract, UI, and alerts must state what is watched, when Automaze responds, and what is not guaranteed.
- **Ladybug signal quality.** Bad deduplication, a poorly chosen recurrence threshold, missing telemetry, or noisy sources can hide important failures or create useless work.
- **Unsafe automated fixes.** A plausible fix can still be wrong. Ladybug may investigate and prepare a PR, but protected operations, senior review, client approval, health checks, and rollback remain mandatory.
- **Steady capacity variance.** One production incident can be far larger than an ordinary ticket. Recurrence policy, investigation limits, SLAs, and fair-use treatment must prevent an unbounded support obligation.
- **Staging isolation.** Per-ticket environments can leak data or secrets, drift from production, collide with one another, or become expensive if cleanup fails.
- **Proof quality and privacy.** A video can demonstrate the wrong path, expose customer data, or create false confidence. Recording scope, redaction, retention, and review standards need to be explicit.
- **Production responsibility.** Clients will call us when something breaks after a release. Ladybug, deployment history, health checks, rollback, and the dated verdict give us a clear operational record, but the contractual boundary still needs to be explicit.
- **Our name on the output.** We didn't write the code, but our process produced it. That's part of the value proposition, but also means our review standards have to be real.
- **Automation risk.** The more of the delivery loop the factory controls, the more important protected operations, permissions, staging isolation, evidence quality, and rollback become.

## Open

Post-deployment monitoring inclusion is resolved: **Ladybug is included in both Active and Steady.** It captures supported production errors and edge cases, deduplicates them, tracks recurrence, filters one-offs, investigates qualifying issues, and may prepare fix PRs. It does not bypass normal Automaze governance or client ship approval.

Still open:

- How existing full-service clients move to Active or Steady, if they want to.
- Size limit per ticket for fair use, and how Ladybug-generated tickets count.
- Exact protected-operation policy.
- Exact Ladybug recurrence threshold and policy. The working idea is roughly more than once per affected user per month, but it needs testing across issue severity, affected-user count, frequency, and time window.
- Which production error and telemetry sources Ladybug supports at launch, and what minimum instrumentation Factory Readiness requires.
- Ladybug investigation limits: time, token budget, environment access, production-data access, and when to stop or escalate.
- Ladybug auto-fix and PR boundaries: which classes of issue it may attempt, which it may only document, and which always require human investigation.
- Ladybug response expectations and SLAs, including whether severity can override recurrence.
- Contractual language around deployment approval, automated security review, Ladybug monitoring, production incidents, proof videos, and staging data.
- Staging environment lifetime, data policy, isolation model, and cleanup policy.
- Proof-of-work video recording, redaction, accessibility, retention, and client access policy.
- Target senior → principal escalation rate before we consider the model proven.