<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => 'The Power of a Plant-Based Diet',
                'slug' => 'power-of-plant-based-diet',
                'category' => 'nutrition',
                'language' => 'en',
                'source_url' => 'https://www.health.harvard.edu/nutrition/plant-based-diet',
                'author' => 'Harvard Health Publishing',
                'excerpt' => 'Discover how shifting toward plant-based meals can boost your energy, reduce inflammation, and lower your carbon footprint.',
                'content' => 'A plant-based diet focuses on foods primarily from plants. This includes not only fruits and vegetables, but also nuts, seeds, oils, whole grains, legumes, and beans. It doesn\'t mean that you are vegetarian or vegan and never eat meat or dairy. Rather, you are proportionately choosing more of your foods from plant sources.

Studies show that plant-based diets are effective for weight management and can lower the risk of heart disease, type 2 diabetes, and certain cancers. The fiber found in plants helps with digestion and keeps you feeling full longer.

Start small: try Meatless Mondays, swap one meal per day for a plant-based option, or explore new grains like quinoa and farro. Your body and the planet will thank you.',
            ],
            [
                'title' => 'Understanding Macros: Protein, Carbs & Fats',
                'slug' => 'understanding-macros-protein-carbs-fats',
                'category' => 'nutrition',
                'language' => 'en',
                'source_url' => 'https://www.mayoclinic.org/healthy-lifestyle/nutrition-and-healthy-eating',
                'author' => 'Mayo Clinic Staff',
                'excerpt' => 'Learn how to balance your macronutrients for optimal energy, muscle recovery, and overall health.',
                'content' => 'Macronutrients are the nutrients your body needs in large amounts: protein, carbohydrates, and fats. Each plays a unique role in keeping your body functioning properly.

Protein is essential for muscle repair, immune function, and enzyme production. Good sources include lean meats, eggs, dairy, legumes, and tofu.

Carbohydrates are your body\'s primary energy source. Focus on complex carbs like whole grains, oats, sweet potatoes, and vegetables rather than refined sugars and white flour.

Healthy fats support brain function, hormone production, and vitamin absorption. Avocados, nuts, olive oil, and fatty fish are excellent choices.

A balanced plate should include all three macros: roughly 30% protein, 40% carbs, and 30% fats, though individual needs vary based on activity level and goals.',
            ],
            [
                'title' => 'Why You Should Drink More Water',
                'slug' => 'why-drink-more-water',
                'category' => 'nutrition',
                'language' => 'en',
                'source_url' => 'https://www.cdc.gov/nutrition/data-statistics/water-and-health.html',
                'author' => 'Centers for Disease Control and Prevention',
                'excerpt' => 'Hydration affects every system in your body. Find out how much water you really need and tips to drink more.',
                'content' => 'Water is essential for life. It makes up about 60% of your body weight and is involved in nearly every bodily function, from regulating temperature to lubricating joints and transporting nutrients.

Dehydration can cause headaches, fatigue, dry skin, and poor concentration. Even mild dehydration of 1-2% of body weight can impair cognitive function and physical performance.

How much do you need? The classic recommendation is 8 glasses (about 2 liters) per day, but needs vary based on activity level, climate, and body size. A simple rule: drink when thirsty and check your urine color \\u2014 pale yellow means you\'re well hydrated.

Tips: carry a reusable water bottle, set hourly reminders, infuse water with fruits for flavor, and eat water-rich foods like cucumber, watermelon, and oranges.',
            ],
            [
                'title' => 'Superfoods That Actually Live Up to the Hype',
                'slug' => 'superfoods-that-live-up-to-hype',
                'category' => 'nutrition',
                'language' => 'en',
                'source_url' => 'https://www.nhs.uk/live-well/eat-well/how-to-eat-a-balanced-diet/',
                'author' => 'UK National Health Service',
                'excerpt' => 'Not all superfoods are created equal. Here are the scientifically-backed ones worth adding to your diet.',
                'content' => 'The term \'superfood\' gets thrown around a lot, but some foods genuinely pack an exceptional nutritional punch. Here are the ones backed by real science:

Blueberries are rich in antioxidants called anthocyanins, which protect against oxidative stress and may improve memory. A handful a day can make a difference.

Leafy greens like kale, spinach, and Swiss chard are loaded with vitamins A, C, K, and folate. They\'re also one of the best sources of lutein, which supports eye health.

Fatty fish such as salmon, mackerel, and sardines provide omega-3 fatty acids EPA and DHA, which are crucial for brain health and reducing inflammation.

Fermented foods like yogurt, kefir, kimchi, and sauerkraut contain probiotics that support gut health, which is linked to immunity, mood, and digestion.

Turmeric contains curcumin, a compound with powerful anti-inflammatory properties. Pair it with black pepper to boost absorption by up to 2000%.',
            ],
            [
                'title' => 'Understanding Diabetes: Prevention Through Lifestyle',
                'slug' => 'understanding-diabetes-prevention',
                'category' => 'prevention',
                'language' => 'en',
                'source_url' => 'https://www.who.int/news-room/fact-sheets/detail/diabetes',
                'author' => 'World Health Organization',
                'excerpt' => 'Type 2 diabetes is largely preventable. Learn the lifestyle changes that can dramatically reduce your risk.',
                'content' => 'Diabetes affects over 400 million people worldwide, but type 2 diabetes \\u2014 the most common form \\u2014 is largely preventable through lifestyle choices.

Excess body weight is the single most important risk factor. Fat cells, especially around the abdomen, release inflammatory substances that can interfere with insulin function. Losing just 5-7% of your body weight can reduce diabetes risk by 58%.

Physical activity helps your cells use insulin more effectively. Aim for at least 150 minutes of moderate-intensity exercise per week. This doesn\'t have to be gym-based \\u2014 brisk walking, cycling, or dancing all count.

Diet matters enormously. Limit sugary drinks, refined carbohydrates, and processed foods. Instead, focus on fiber-rich foods like vegetables, legumes, and whole grains, which slow sugar absorption.

Regular check-ups are important, especially if you have a family history of diabetes or are over 40. Early detection can prevent complications.',
            ],
            [
                'title' => 'The Hidden Dangers of Air Pollution on Your Health',
                'slug' => 'hidden-dangers-air-pollution-health',
                'category' => 'prevention',
                'language' => 'en',
                'source_url' => 'https://www.who.int/health-topics/air-pollution',
                'author' => 'World Health Organization',
                'excerpt' => 'Air pollution is more than an environmental issue \\u2014 it directly affects your lungs, heart, and brain.',
                'content' => 'Air pollution is responsible for an estimated 7 million premature deaths worldwide each year, according to the World Health Organization. The tiny particles known as PM2.5 can penetrate deep into your lungs and even enter your bloodstream.

Short-term exposure can cause eye and throat irritation, coughing, and shortness of breath. Long-term exposure is linked to serious conditions including asthma, lung cancer, heart disease, stroke, and even cognitive decline.

What can you do? Check daily air quality indexes before outdoor activities, especially if you have respiratory conditions. On high-pollution days, exercise indoors and keep windows closed.

At home, use an air purifier with a HEPA filter, keep indoor plants like snake plants and peace lilies, and avoid burning candles or incense. Wearing an N95 mask when pollution levels are very high can also help.

On a community level, support clean energy initiatives, use public transportation, and advocate for stricter emissions standards.',
            ],
            [
                'title' => 'Why Sitting Too Much Is Killing You Slowly',
                'slug' => 'why-sitting-too-much-is-killing-you',
                'category' => 'prevention',
                'language' => 'en',
                'source_url' => 'https://www.mayoclinic.org/healthy-lifestyle/adult-health/expert-answers/sitting/faq-20058005',
                'author' => 'Mayo Clinic Staff',
                'excerpt' => 'Prolonged sitting increases risk of heart disease, obesity, and early death. Here is how to counteract it.',
                'content' => 'Modern life keeps us sitting more than ever \\u2014 at desks, in cars, and on couches. Studies show that prolonged sitting increases the risk of cardiovascular disease, type 2 diabetes, obesity, and even certain cancers.

The problem is that when you sit, your large muscles are inactive, which reduces blood flow and calorie burning. Sitting also puts pressure on your spine and can lead to chronic back pain.

The solution isn\'t just exercise. Even if you work out for an hour daily, sitting for the remaining 15 hours can still harm your health. The key is to break up sedentary time.

Try these strategies: stand or walk while taking phone calls, use a standing desk for part of the day, take a 2-minute walk break every 30 minutes, stretch at your desk, and consider walking meetings.

Aim to accumulate at least 30 minutes of movement throughout your day beyond your regular exercise routine.',
            ],
            [
                'title' => 'Boost Your Immune System Naturally',
                'slug' => 'boost-immune-system-naturally',
                'category' => 'prevention',
                'language' => 'en',
                'source_url' => 'https://www.health.harvard.edu/staying-healthy/how-to-boost-your-immune-system',
                'author' => 'Harvard Health Publishing',
                'excerpt' => 'Your immune system is your body defense against illness. Learn natural ways to keep it strong year-round.',
                'content' => 'A strong immune system is your best defense against infections and illness. While no supplement can \'boost\' your immune system beyond its normal capacity, certain lifestyle habits help it function optimally.

Sleep is foundational. During deep sleep, your body produces cytokines \\u2014 proteins that target infection and inflammation. Adults need 7-9 hours of quality sleep per night.

Nutrition plays a key role. Vitamin C from citrus fruits, bell peppers, and broccoli supports immune cell function. Zinc from nuts, seeds, and legumes helps immune cells develop. Vitamin D from sunlight or supplements is crucial for immune regulation.

Exercise improves circulation, which allows immune cells to move through the body more efficiently. Aim for moderate exercise like brisk walking for 30 minutes most days.

Chronic stress suppresses immunity by producing cortisol, which reduces the effectiveness of immune cells. Incorporate stress management techniques like meditation, deep breathing, or spending time in nature.

Stay hydrated, limit alcohol, and don\'t smoke \\u2014 these are the foundations of a healthy immune response.',
            ],
            [
                'title' => 'Mindfulness Meditation for Beginners',
                'slug' => 'mindfulness-meditation-beginners',
                'category' => 'mental',
                'language' => 'en',
                'source_url' => 'https://www.nccih.nih.gov/health/meditation-and-mindfulness-what-you-need-to-know',
                'author' => 'National Center for Complementary and Integrative Health',
                'excerpt' => 'Start your mindfulness journey with this simple guide. Just 10 minutes a day can reduce stress and improve focus.',
                'content' => 'Mindfulness is the practice of being present in the moment without judgment. Research shows it reduces stress, improves concentration, and helps manage anxiety and depression.

Getting started is simpler than you think. Find a quiet spot, sit comfortably, and set a timer for 5-10 minutes. Close your eyes and focus on your breath \\u2014 the sensation of air entering and leaving your nostrils or the rise and fall of your chest.

Your mind will wander. This is normal and expected. When you notice your thoughts drifting, simply acknowledge it without judgment and gently bring your attention back to your breath.

Start with guided meditations using apps like Headspace or Calm. Even a few minutes daily can make a difference. Consistency matters more than duration.

Over time, mindfulness trains your brain to be less reactive to stress and more aware of the present moment. Many practitioners report better sleep, improved relationships, and greater emotional resilience after just a few weeks of regular practice.',
            ],
            [
                'title' => 'Breaking the Stigma: Talking About Mental Health',
                'slug' => 'breaking-stigma-mental-health',
                'category' => 'mental',
                'language' => 'en',
                'source_url' => 'https://www.who.int/news-room/fact-sheets/detail/mental-health-strengthening-our-response',
                'author' => 'World Health Organization',
                'excerpt' => 'Mental health matters as much as physical health. Learn how to start conversations and support others.',
                'content' => 'Mental health affects everyone, yet stigma prevents many from seeking help. Depression is the leading cause of disability worldwide, and anxiety disorders affect more than 260 million people.

Talking openly about mental health is one of the most powerful ways to break the stigma. Start by using person-first language \\u2014 say \'someone with schizophrenia\' rather than \'a schizophrenic.\' Avoid using clinical terms like \'depressed\' or \'OCD\' as casual descriptors.

If someone confides in you about their mental health, listen without judgment. Don\'t try to fix their problems or compare their experience to others. Simply say, \'Thank you for trusting me. I\'m here for you.\'

Encourage professional help when needed. Therapists, counselors, and support groups can provide tools and strategies that friends and family cannot. Many workplaces now offer Employee Assistance Programs with free counseling sessions.

Remember: mental health conditions are medical conditions, not character flaws. Seeking help is a sign of strength, not weakness.',
            ],
            [
                'title' => 'The Science of Sleep: Why Your Bedtime Matters',
                'slug' => 'science-of-sleep-why-bedtime-matters',
                'category' => 'mental',
                'language' => 'en',
                'source_url' => 'https://www.cdc.gov/sleep/about_sleep/sleep_hygiene.html',
                'author' => 'Centers for Disease Control and Prevention',
                'excerpt' => 'Poor sleep affects mood, memory, and even your lifespan. Discover the science behind good sleep hygiene.',
                'content' => 'Sleep is not a luxury \\u2014 it\'s a biological necessity. During sleep, your brain processes memories, clears out metabolic waste, and regulates emotions. Chronic sleep deprivation is linked to depression, anxiety, obesity, and heart disease.

Your circadian rhythm, or internal body clock, regulates sleep-wake cycles. Exposure to natural light during the day and darkness at night keeps this rhythm synchronized. Blue light from phones and laptops disrupts melatonin production, making it harder to fall asleep.

Good sleep hygiene starts with consistency: go to bed and wake up at the same time every day, even on weekends. Create a relaxing bedtime routine \\u2014 reading, gentle stretching, or a warm bath signal to your body that it\'s time to wind down.

Your bedroom environment matters too. Keep it cool (around 65-68\\u00b0F or 18-20\\u00b0C), dark, and quiet. Invest in a comfortable mattress and pillows.

Avoid caffeine after 2 PM, limit alcohol before bed, and finish meals at least 2-3 hours before sleeping. If you can\'t fall asleep after 20 minutes, get up and do something relaxing until you feel sleepy.',
            ],
            [
                'title' => 'Managing Stress in a Fast-Paced World',
                'slug' => 'managing-stress-fast-paced-world',
                'category' => 'mental',
                'language' => 'en',
                'source_url' => 'https://www.nimh.nih.gov/health/publications/stress',
                'author' => 'National Institute of Mental Health',
                'excerpt' => 'Chronic stress is harmful, but manageable. Learn practical techniques to stay calm and resilient.',
                'content' => 'Stress is a natural response to challenges, but chronic stress keeps your body in a constant state of \'fight or flight,\' leading to health problems like high blood pressure, weakened immunity, and burnout.

The first step is recognizing your stress signals \\u2014 tension headaches, irritability, fatigue, changes in appetite, or trouble sleeping. Once you recognize the signs, you can take action.

Deep breathing is one of the fastest ways to activate your relaxation response. Try box breathing: inhale for 4 counts, hold for 4, exhale for 4, hold for 4. Repeat 3-5 times.

Physical activity is a powerful stress reliever. Exercise produces endorphins and gives your mind a break from worries. Even a 10-minute walk can help.

Set boundaries between work and personal life. Learn to say no to non-essential commitments. Schedule regular downtime and hobbies that bring you joy.

Stay connected with people who support you. Social connection is one of the strongest buffers against stress. A phone call with a friend can be more effective than hours of worrying alone.',
            ],
            [
                'title' => 'How Climate Change Is Affecting Your Health',
                'slug' => 'climate-change-affecting-health',
                'category' => 'environment',
                'language' => 'en',
                'source_url' => 'https://www.who.int/news-room/fact-sheets/detail/climate-change-and-health',
                'author' => 'World Health Organization',
                'excerpt' => 'Rising temperatures and extreme weather have direct impacts on physical and mental well-being.',
                'content' => 'Climate change isn\'t just an environmental issue \\u2014 it\'s a public health crisis. The World Health Organization estimates that between 2030 and 2050, climate change will cause approximately 250,000 additional deaths per year from malnutrition, malaria, diarrhea, and heat stress.

Heat waves are becoming more frequent and intense, causing heat exhaustion, heat stroke, and worsening cardiovascular and respiratory conditions. Urban areas with less green space are especially vulnerable due to the \'heat island\' effect.

Air quality is worsening as wildfires become more common and pollen seasons lengthen. This exacerbates asthma, allergies, and other respiratory conditions. Children, the elderly, and those with pre-existing conditions are most at risk.

Infectious diseases are spreading to new regions as temperatures rise. Mosquito-borne illnesses like dengue and malaria are appearing in areas previously too cold for these vectors.

On a positive note, many climate solutions also improve health: walking and cycling reduce emissions and boost fitness, plant-based diets lower your carbon footprint and reduce disease risk, and clean energy reduces air pollution.',
            ],
            [
                'title' => 'Eco-Friendly Habits That Save You Money',
                'slug' => 'eco-friendly-habits-save-money',
                'category' => 'environment',
                'language' => 'en',
                'source_url' => 'https://www.epa.gov/recycle/reducing-wasted-food-home',
                'author' => 'U.S. Environmental Protection Agency',
                'excerpt' => 'Going green doesn\'t have to be expensive. These sustainable habits will actually put money back in your pocket.',
                'content' => 'Living sustainably is often associated with higher costs, but many eco-friendly habits actually save you money in the long run.

Reduce energy use: switching to LED bulbs uses 75% less energy and lasts 25 times longer than incandescent bulbs. Unplug electronics when not in use to eliminate \'vampire power\' drain, which can account for 10% of your electricity bill.

Cut food waste: the average household wastes about 30% of the food they buy. Plan meals weekly, store food properly to extend freshness, and use leftovers creatively. Composting what you can\'t eat reduces methane emissions from landfills.

Use less water: fix leaky faucets, install low-flow showerheads, and collect rainwater for plants. These changes can cut your water bill significantly.

Buy less, choose well: invest in quality items that last instead of cheap disposable products. Borrow or rent tools you use infrequently. Thrift shopping saves money and reduces demand for new production.

Transportation: walking, cycling, and using public transit save money on fuel, parking, and vehicle maintenance while reducing emissions.',
            ],
            [
                'title' => 'Plastic Pollution: What You Can Do About It',
                'slug' => 'plastic-pollution-what-you-can-do',
                'category' => 'environment',
                'language' => 'en',
                'source_url' => 'https://www.unep.org/news-and-stories/story/plastic-pollution-what-you-can-do',
                'author' => 'United Nations Environment Programme',
                'excerpt' => 'Single-use plastics are choking our oceans. Simple swaps can dramatically reduce your plastic footprint.',
                'content' => 'Every year, 8 million tons of plastic enter the ocean \\u2014 that\'s equivalent to dumping a garbage truck full of plastic into the ocean every minute. Microplastics have been found in drinking water, seafood, and even human blood.

The good news: individual actions add up. Start with the most impactful swaps. Replace single-use water bottles with a reusable stainless steel or glass bottle. Carry a reusable shopping bag and produce bags. Say no to plastic straws and stirrers.

In the kitchen, store food in glass containers instead of plastic wrap or ziplock bags. Buy in bulk to reduce packaging and bring your own containers when possible. Choose products in cardboard, glass, or metal over plastic packaging.

In the bathroom, switch to shampoo bars instead of plastic bottles, use bamboo toothbrushes, and try refillable or plastic-free deodorant and lotion options.

Support businesses that are reducing plastic waste and advocate for policies that ban unnecessary single-use plastics. Every piece of plastic you avoid is one that won\'t end up in the ocean.',
            ],
            [
                'title' => 'The Perfect Home Workout Routine',
                'slug' => 'perfect-home-workout-routine',
                'category' => 'fitness',
                'language' => 'en',
                'source_url' => 'https://www.health.harvard.edu/exercise-and-fitness/the-ultimate-home-workout',
                'author' => 'Harvard Health Publishing',
                'excerpt' => 'No gym? No problem. Build an effective home workout with just your bodyweight and 20 minutes a day.',
                'content' => 'You don\'t need a gym membership or fancy equipment to get fit. A well-designed bodyweight routine can build strength, improve cardiovascular health, and burn calories effectively.

Start with a 5-minute warm-up: jumping jacks, arm circles, leg swings, and torso twists. This increases blood flow and reduces injury risk.

Your main workout can be a circuit of 6 exercises performed back to back with minimal rest:

1. Squats \\u2014 15 reps (targets legs and glutes)
2. Push-ups \\u2014 10 reps (chest, shoulders, triceps; do knee push-ups if needed)
3. Lunges \\u2014 12 each leg (legs and balance)
4. Plank \\u2014 30 seconds (core stability)
5. Glute bridges \\u2014 15 reps (glutes and lower back)
6. Mountain climbers \\u2014 30 seconds (full body cardio)

Repeat the circuit 2-4 times with 60 seconds rest between rounds. Finish with a 5-minute cool-down and stretching.

For best results, do this routine 4-5 times per week, gradually increasing reps, hold times, or circuit rounds as you get stronger.',
            ],
            [
                'title' => 'Walking: The Underrated Exercise for Longevity',
                'slug' => 'walking-underrated-exercise-longevity',
                'category' => 'fitness',
                'language' => 'en',
                'source_url' => 'https://www.mayoclinic.org/healthy-lifestyle/fitness/expert-answers/walking/faq-20058345',
                'author' => 'Mayo Clinic Staff',
                'excerpt' => 'Walking is free, accessible, and one of the best things you can do for long-term health.',
                'content' => 'Walking is often overlooked as a form of exercise, yet it\'s one of the most effective activities for long-term health and longevity. Studies show that regular walking reduces the risk of heart disease, stroke, type 2 diabetes, and certain cancers.

Aim for at least 7,000-10,000 steps per day. If you\'re starting from a sedentary lifestyle, even 4,000-5,000 steps provides significant health benefits compared to being completely inactive.

To increase the benefits, try interval walking: alternate between 3 minutes at a comfortable pace and 1 minute at a brisk pace. This boosts cardiovascular fitness more than steady-paced walking.

Walking after meals \\u2014 especially dinner \\u2014 helps regulate blood sugar levels. A 10-15 minute post-meal walk can reduce blood sugar spikes by up to 22%.

Walking outdoors provides additional benefits: exposure to sunlight boosts vitamin D levels, and time in nature reduces stress and improves mood. If outdoor walking isn\'t possible, a treadmill or even indoor walking works well.

Make walking social by inviting friends or family, listening to podcasts or audiobooks, or exploring new routes in your neighborhood.',
            ],
            [
                'title' => 'Stretching 101: Improve Flexibility and Prevent Injury',
                'slug' => 'stretching-101-improve-flexibility',
                'category' => 'fitness',
                'language' => 'en',
                'source_url' => 'https://www.nhs.uk/live-well/exercise/how-to-stretch-after-exercise/',
                'author' => 'UK National Health Service',
                'excerpt' => 'Flexibility is a key component of fitness. Learn when and how to stretch for maximum benefit.',
                'content' => 'Stretching is often the most neglected part of a fitness routine, but it\'s essential for maintaining mobility, preventing injury, and improving performance.

There are two main types of stretching. Dynamic stretching involves moving parts of your body through a full range of motion \\u2014 leg swings, arm circles, torso twists. This is best done before exercise to warm up muscles and prepare them for activity.

Static stretching involves holding a position for 15-60 seconds. This is best done after exercise when muscles are warm and pliable. Post-workout stretching helps reduce muscle soreness and improves flexibility over time.

Key stretches for beginners: hamstring stretch (sit on floor, reach for toes), quad stretch (stand, pull heel toward glute), chest stretch (clasp hands behind back, open chest), child\'s pose (kneel, reach arms forward), and cat-cow stretch (on all fours, arch and round spine).

Consistency matters more than intensity. Stretching for 5-10 minutes daily will yield better results than an hour once a week. Breathe deeply while stretching \\u2014 never bounce or force a stretch beyond mild tension.

Good flexibility improves posture, reduces back pain, enhances athletic performance, and makes everyday movements easier.',
            ],
            [
                'title' => 'How to Stay Active During the Rainy Season',
                'slug' => 'stay-active-during-rainy-season',
                'category' => 'fitness',
                'language' => 'en',
                'source_url' => 'https://www.cdc.gov/physicalactivity/basics/indoor-workouts.html',
                'author' => 'Centers for Disease Control and Prevention',
                'excerpt' => 'Don\'t let bad weather derail your fitness goals. Indoor activities that keep you moving when it\'s pouring outside.',
                'content' => 'Rainy days often disrupt outdoor exercise routines, but they don\'t have to derail your fitness goals. With a little creativity, you can stay active indoors without stepping foot in a gym.

Bodyweight workouts are the most accessible option. Squats, push-ups, lunges, planks, and burpees require zero equipment and can be done in any space. Follow along with free YouTube workout videos for structure and motivation.

Stair climbing is an excellent cardio workout if you have stairs at home. Walk or jog up and down for 10-15 minutes. This strengthens your legs, glutes, and cardiovascular system.

Dance workouts are fun and effective. Put on your favorite music and dance \\u2014 even 20 minutes of dancing burns calories and lifts your mood. For structure, try Zumba or hip-hop dance tutorials online.

Yoga and Pilates are perfect for rainy days. They build strength, improve flexibility, and reduce stress. Many apps and YouTube channels offer free classes for all levels.

Jump rope is a high-intensity workout that burns up to 10 calories per minute. A few minutes of jump rope interspersed with bodyweight exercises creates an effective HIIT session.

Remember: consistency beats intensity. Even a 15-minute indoor workout is better than skipping exercise entirely.',
            ],
            [
                'title' => 'Jamu: Warisan Leluhur yang Kaya Manfaat Kesehatan',
                'slug' => 'jamu-warisan-leluhur-manfaat-kesehatan',
                'category' => 'nutrition',
                'language' => 'id',
                'source_url' => 'https://www.kemkes.go.id/article/view/22042000001/jamu-minuman-tradisional-kaya-manfaat.html',
                'author' => 'Kementerian Kesehatan RI',
                'excerpt' => 'Jamu bukan sekadar minuman tradisional, tetapi warisan budaya yang memiliki segudang manfaat bagi kesehatan tubuh.',
                'content' => 'Jamu adalah minuman tradisional Indonesia yang telah dikenal sejak berabad-abad lalu. Terbuat dari bahan-bahan alami seperti kunyit, jahe, temulawak, dan berbagai rempah lainnya, jamu dipercaya mampu menjaga kesehatan dan mengobati berbagai penyakit.

Kunyit asam, salah satu jamu paling populer, mengandung kurkumin yang bersifat anti-inflamasi dan antioksidan. Minuman ini dipercaya dapat meredakan nyeri haid, meningkatkan daya tahan tubuh, dan menjaga kesehatan hati.

Berbagai penelitian modern telah membuktikan khasiat jamu secara ilmiah. Jahe misalnya, dikenal efektif mengatasi mual dan gangguan pencernaan. Temulawak bermanfaat untuk meningkatkan fungsi hati dan nafsu makan.

Untuk mendapatkan manfaat optimal, konsumsilah jamu secara rutin tanpa tambahan gula berlebih. Takaran yang tepat dan bahan berkualitas menjadi kunci utama.

Jamu adalah bukti bahwa kearifan lokal Indonesia memiliki nilai kesehatan yang tak ternilai. Mari lestarikan warisan leluhur ini untuk generasi mendatang.',
            ],
            [
                'title' => 'Mengenal Demam Berdarah: Gejala, Pencegahan, dan Pengobatan',
                'slug' => 'mengenal-demam-berdarah-gejala-pencegahan',
                'category' => 'prevention',
                'language' => 'id',
                'source_url' => 'https://www.kemkes.go.id/article/view/23010100001/demam-berdarah-dengue.html',
                'author' => 'Kementerian Kesehatan RI',
                'excerpt' => 'Demam Berdarah Dengue (DBD) masih menjadi ancaman serius di Indonesia. Kenali gejala dan cara pencegahannya.',
                'content' => 'Demam Berdarah Dengue (DBD) adalah penyakit yang disebabkan oleh virus dengue yang ditularkan melalui gigitan nyamuk Aedes aegypti. Indonesia termasuk negara dengan kasus DBD tertinggi di Asia Tenggara.

Gejala DBD meliputi demam tinggi mendadak (38-40\\u00b0C) selama 2-7 hari, nyeri otot dan sendi, sakit kepala berat, nyeri di belakang mata, serta munculnya bintik-bintik merah pada kulit. Pada fase kritis, dapat terjadi perdarahan dan syok yang mengancam jiwa.

Pencegahan DBD dilakukan melalui program 3M Plus: Menguras tempat penampungan air, Menutup rapat tempat penyimpanan air, Mendaur ulang barang bekas, dan Plus-nya seperti menggunakan lotion anti-nyamuk, memasang kawat kasa, dan menanam tanaman pengusir nyamuk.

Vaksin dengue kini tersedia dan dapat diberikan sesuai rekomendasi dokter. Jika mengalami gejala DBD, segera periksakan ke fasilitas kesehatan terdekat. Istirahat cukup dan konsumsi cairan yang banyak sangat dianjurkan.

Mari bersama-sama melakukan Pemberantasan Sarang Nyamuk (PSN) secara rutin setiap minggu untuk melindungi keluarga dari ancaman DBD.',
            ],
            [
                'title' => 'Mengatasi Stres dengan Pendekatan Kearifan Lokal Indonesia',
                'slug' => 'mengatasi-stres-kearifan-lokal-indonesia',
                'category' => 'mental',
                'language' => 'id',
                'source_url' => 'https://www.alodokter.com/cara-mengatasi-stres-secara-alami',
                'author' => 'Alodokter',
                'excerpt' => 'Budaya Indonesia memiliki banyak cara alami untuk mengelola stres. Temukan pendekatan tradisional yang masih relevan.',
                'content' => 'Stres adalah bagian tak terpisahkan dari kehidupan modern. Namun, budaya Indonesia memiliki kearifan lokal yang dapat membantu kita mengelola stres secara alami.

Berkebun atau bercocok tanam, yang sudah menjadi tradisi masyarakat pedesaan, ternyata memiliki efek terapeutik. Aktivitas ini dapat menurunkan kadar kortisol dan meningkatkan rasa tenang.

Gotong royong dan silaturahmi dengan tetangga juga menjadi peredam stres yang efektif. Interaksi sosial yang hangat, sekadar ngobrol sambil minum kopi atau teh, dapat memperbaiki suasana hati dan mengurangi rasa kesepian.

Bermeditasi dengan cara dzikir atau doa sesuai keyakinan juga merupakan bentuk mindfulness yang telah dipraktikkan turun-temurun. Duduk tenang sambil mengatur napas dan mengingat Tuhan dapat menenangkan pikiran.

Mendengarkan musik gamelan atau alunan nyanyian tradisional juga terbukti dapat menurunkan tekanan darah dan merelaksasi pikiran.

Kuncinya adalah melakukan aktivitas yang membuat Anda hadir sepenuhnya pada momen sekarang, tanpa memikirkan masa lalu atau masa depan.',
            ],
            [
                'title' => 'Polusi Udara di Kota Besar: Dampak dan Cara Melindungi Diri',
                'slug' => 'polusi-udara-kota-besar-dampak-perlindungan',
                'category' => 'environment',
                'language' => 'id',
                'source_url' => 'https://www.sehatq.com/artikel/pengaruh-polusi-udara-bagi-kesehatan',
                'author' => 'SehatQ',
                'excerpt' => 'Polusi udara di kota-kota besar Indonesia semakin mengkhawatirkan. Ketahui dampaknya bagi kesehatan dan cara melindungi diri.',
                'content' => 'Polusi udara telah menjadi masalah serius di kota-kota besar Indonesia seperti Jakarta, Surabaya, dan Bandung. Tingkat PM2.5 yang tinggi seringkali melampaui ambang batas aman yang ditetapkan WHO.

Dampak polusi udara terhadap kesehatan sangat beragam, mulai dari iritasi mata dan saluran pernapasan, hingga penyakit kronis seperti ISPA, asma, bronkitis kronis, dan penyakit jantung. Anak-anak dan lansia adalah kelompok yang paling rentan.

Beberapa langkah yang dapat dilakukan untuk melindungi diri: gunakan masker N95 saat beraktivitas di luar ruangan, pasang air purifier di dalam rumah, dan kurangi aktivitas luar ruangan saat kualitas udara buruk.

Tanaman hias seperti lidah mertua (Sansevieria) dan sirih gading dapat membantu menyaring udara di dalam ruangan secara alami.

Dalam jangka panjang, dukung kebijakan yang mendorong penggunaan transportasi massal, pengurangan emisi kendaraan, dan penghijauan kota. Setiap langkah kecil untuk udara bersih berarti bagi kesehatan kita bersama.',
            ],
            [
                'title' => 'Senam Pagi: Olahraga Sederhana untuk Kebugaran Sehari-hari',
                'slug' => 'senam-pagi-olahraga-sederhana-kebugaran',
                'category' => 'fitness',
                'language' => 'id',
                'source_url' => 'https://www.kemkes.go.id/article/view/19010100001/manfaat-senam-pagi-bagi-kesehatan.html',
                'author' => 'Kementerian Kesehatan RI',
                'excerpt' => 'Senam pagi adalah kebiasaan sehat yang murah dan mudah. Lakukan 15-20 menit setiap pagi untuk hasil maksimal.',
                'content' => 'Senam pagi telah menjadi bagian dari budaya kesehatan masyarakat Indonesia selama puluhan tahun. Mulai dari senam aerobik, senam poco-poco, hingga senam SKJ, semua memberikan manfaat luar biasa bagi kesehatan.

Senam pagi yang dilakukan secara rutin dapat meningkatkan sirkulasi darah, memperkuat otot dan sendi, membakar kalori, serta meningkatkan fleksibilitas tubuh. Tidak perlu gerakan yang rumit - gerakan sederhana seperti jalan di tempat, peregangan, dan gerakan tangan sudah cukup.

Lakukan pemanasan selama 5 menit, dilanjutkan gerakan inti selama 10-15 menit, dan diakhiri dengan pendinginan. Musik yang ceria dapat menambah semangat.

Senam pagi juga menjadi ajang sosialisasi yang menyenangkan. Banyak komunitas senam di taman-taman kota yang bisa Anda ikuti secara gratis.

Konsistensi adalah kunci. Mulailah dengan durasi pendek dan tingkatkan secara bertahap. Tubuh yang bugar akan membuat Anda lebih produktif sepanjang hari.',
            ],
            [
                'title' => 'Tempe: Superfood Lokal yang Mendunia',
                'slug' => 'tempe-superfood-lokal-mendunia',
                'category' => 'nutrition',
                'language' => 'id',
                'source_url' => 'https://www.halodoc.com/artikel/tempe-superfood-lokal-yang-kaya-manfaat',
                'author' => 'Halodoc',
                'excerpt' => 'Tempe bukan sekadar lauk murah, tetapi superfood asli Indonesia yang diakui dunia karena nilai gizinya yang luar biasa.',
                'content' => 'Tempe adalah makanan fermentasi khas Indonesia yang terbuat dari kacang kedelai. Proses fermentasi oleh jamur Rhizopus oligosporus membuat tempe memiliki nilai gizi yang lebih baik dibandingkan bahan dasarnya.

Tempe mengandung protein nabati berkualitas tinggi, serat, vitamin B12 (yang jarang ditemukan pada makanan nabati), zat besi, kalsium, dan antioksidan. Kandungan protein tempe bahkan setara dengan daging.

Proses fermentasi juga menghasilkan senyawa bioaktif yang bersifat antioksidan, anti-inflamasi, dan antikanker. Tempe juga lebih mudah dicerna dibandingkan kedelai utuh.

Tempe sangat fleksibel diolah: digoreng tepung, ditumis, dibacem, dijadikan keripik, atau diolah menjadi burger tempe. Harganya yang terjangkau membuatnya menjadi sumber protein nabati yang sangat ekonomis.

Para ahli gizi di seluruh dunia merekomendasikan tempe sebagai bagian dari diet sehat berkelanjutan. Bangga dengan produk lokal Indonesia yang mendunia ini!',
            ],
            [
                'title' => 'Mengenal ISPA: Infeksi Saluran Pernapasan Akut di Musim Pancaroba',
                'slug' => 'mengenal-ispa-infeksi-saluran-pernapasan',
                'category' => 'prevention',
                'language' => 'id',
                'source_url' => 'https://www.kemkes.go.id/article/view/23031500001/mengenal-ispa-dan-cara-mencegahnya.html',
                'author' => 'Kementerian Kesehatan RI',
                'excerpt' => 'ISPA sering menyerang saat pergantian musim. Pelajari gejala, penyebab, dan cara pencegahannya.',
                'content' => 'Infeksi Saluran Pernapasan Akut (ISPA) adalah infeksi yang menyerang saluran pernapasan mulai dari hidung hingga paru-paru. ISPA sangat umum terjadi di Indonesia, terutama pada musim pancaroba saat cuaca tidak menentu.

Gejala ISPA meliputi batuk, pilek, sakit tenggorokan, demam ringan, dan hidung tersumbat. Pada kasus yang lebih berat, dapat disertai sesak napas dan demam tinggi.

Penyebabnya sebagian besar adalah virus (80-90%), sehingga antibiotik tidak selalu diperlukan. Istirahat cukup, minum air hangat, dan konsumsi makanan bergizi adalah penanganan utama.

Pencegahan ISPA dapat dilakukan dengan: mencuci tangan secara teratur, menggunakan masker saat sakit atau di keramaian, menjaga daya tahan tubuh dengan makan sehat dan olahraga, serta istirahat yang cukup.

Jika gejala tidak membaik setelah 3-5 hari atau disertai demam tinggi dan sesak napas, segera periksakan ke fasilitas kesehatan.',
            ],
            [
                'title' => 'Manfaat Berjemur di Bawah Sinar Matahari Pagi',
                'slug' => 'manfaat-berjemur-sinar-matahari-pagi',
                'category' => 'mental',
                'language' => 'id',
                'source_url' => 'https://www.alodokter.com/manfaat-berjemur-di-pagi-hari',
                'author' => 'Alodokter',
                'excerpt' => 'Berjemur di pagi hari bukan sekadar tren, tetapi kebutuhan kesehatan. Ketahui waktu dan durasi yang tepat.',
                'content' => 'Berjemur di bawah sinar matahari pagi telah menjadi kebiasaan yang dianjurkan oleh para ahli kesehatan di Indonesia. Paparan sinar matahari pagi membantu tubuh memproduksi vitamin D secara alami.

Vitamin D berperan penting dalam penyerapan kalsium untuk kesehatan tulang, meningkatkan sistem kekebalan tubuh, serta mengatur suasana hati. Kekurangan vitamin D dikaitkan dengan depresi, kelelahan, dan penurunan imunitas.

Waktu terbaik untuk berjemur adalah pukul 07.00-09.00 pagi, selama 10-15 menit. Paparan sinar UVB pada jam ini cukup untuk memproduksi vitamin D tanpa risiko terbakar sinar matahari.

Berjemurlah di area yang terkena sinar matahari langsung, dengan lengan dan wajah terbuka. Tidak perlu menggunakan tabir surya saat berjemur singkat di pagi hari.

Setelah berjemur, konsumsi makanan yang mengandung kalsium seperti susu, tahu, atau sayuran hijau untuk memaksimalkan penyerapan vitamin D. Jadikan berjemur sebagai rutinitas pagi yang menyenangkan.',
            ],
            [
                'title' => 'Hidup Minimalis: Gaya Hidup Ramah Lingkungan ala Indonesia',
                'slug' => 'hidup-minimalis-gaya-hidup-ramah-lingkungan',
                'category' => 'environment',
                'language' => 'id',
                'source_url' => 'https://nationalgeographic.grid.id/read/133456789/hidup-minimalis-kunci-keberlanjutan-lingkungan',
                'author' => 'National Geographic Indonesia',
                'excerpt' => 'Gaya hidup minimalis tidak hanya menghemat uang, tetapi juga mengurangi dampak lingkungan. Cocok diterapkan di Indonesia.',
                'content' => 'Hidup minimalis adalah gaya hidup yang berfokus pada kepemilikan barang yang benar-benar dibutuhkan dan memberikan nilai kebahagiaan. Di Indonesia, konsep ini sejalan dengan filosofi hidup sederhana yang sudah lama dikenal.

Mulailah dengan merapikan rumah menggunakan metode KonMari atau metode Jepang lainnya. Tanyakan pada diri sendiri apakah setiap barang masih berguna dan membawa kebahagiaan. Barang yang tidak terpakai bisa didonasikan atau didaur ulang.

Kurangi pembelian impulsif dengan menerapkan aturan 30 hari: jika ingin membeli barang non-esensial, tunggu 30 hari. Jika setelah itu masih dianggap perlu, baru dibeli. Ini mengurangi pembelian yang tidak perlu secara signifikan.

Dalam konteks Indonesia, hidup minimalis bisa berarti: membawa tas belanja sendiri ke pasar tradisional, menggunakan kemasan isi ulang untuk sabun dan deterjen, serta memanfaatkan barang bekas menjadi kerajinan tangan.

Hidup minimalis bukan berarti hidup kekurangan, tetapi hidup dengan lebih sadar dan bertanggung jawab terhadap lingkungan.',
            ],
            [
                'title' => 'Olahraga Air: Alternatif Sehat di Negara Tropis',
                'slug' => 'olahraga-air-alternatif-sehat-negara-tropis',
                'category' => 'fitness',
                'language' => 'id',
                'source_url' => 'https://www.halodoc.com/artikel/manfaat-olahraga-air-bagi-kesehatan-tubuh',
                'author' => 'Halodoc',
                'excerpt' => 'Indonesia sebagai negara tropis memiliki potensi besar untuk olahraga air. Nikmati kebugaran sambil bermain air.',
                'content' => 'Sebagai negara kepulauan terbesar di dunia, Indonesia memiliki kekayaan alam yang mendukung berbagai olahraga air. Dari berenang, snorkeling, selancar, hingga dayung, semua bisa dinikmati di perairan Indonesia.

Berenang adalah olahraga air paling dasar yang memberikan manfaat luar biasa. Renang melatih hampir seluruh otot tubuh, meningkatkan kapasitas paru-paru, dan membakar kalori hingga 500 kalori per jam. Kolam renang umum banyak tersedia di kota-kota besar dengan tarif terjangkau.

Snorkeling dan diving tidak hanya menyenangkan tetapi juga memberikan latihan kardio yang baik. Melihat keindahan terumbu karang dan biota laut juga memberikan efek relaksasi dan mengurangi stres.

Berselancar (surfing) telah menjadi olahraga populer di destinasi seperti Bali, Mentawai, dan Lombok. Olahraga ini melatih keseimbangan, kekuatan inti tubuh, dan kesabaran.

Dayung dan kano juga bisa dinikmati di danau-danau indah Indonesia seperti Danau Toba, Danau Singkarak, atau Danau Sentani. Olahraga ini sangat baik untuk melatih otot lengan, punggung, dan ketahanan kardiovaskular.

Pastikan selalu mematuhi aturan keselamatan saat berolahraga air. Gunakan jaket pelampung, jangan berenang sendirian, dan perhatikan kondisi cuaca.',
            ],
        ];

        foreach ($articles as $data) {
            Article::create($data + [
                'is_published' => true,
                'published_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23)),
            ]);
        }
    }
}
